<?php

namespace App\Livewire\Admin;

use Storage;
use App\Models\Posisi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Pegawai as modelPegawai;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class Pegawai extends Component
{
    use WithPagination, WithFileUploads;
    public $forceRefresh = false;
    public $search = '';
    public $pegawaiId = null, $nama, $telepon, $alamat, $birth, $salary, $posisi_id, $image, $oldImage, $is_active = true;
    public $modalPegawai = false, $modalConfirmDelete = false;
    public $posisis = [];

    protected $rules = [
        'nama' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'birth' => 'required|date',
        'salary' => 'nullable|numeric',
        'posisi_id' => 'required|exists:posisis,id',
        'image' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
    ];

    public function mount()
    {
        // $this->posisis = Posisi::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function simpan()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('pegawai', 'public') : $this->oldImage;

        if ($this->pegawaiId) {
            $pegawai = modelPegawai::findOrFail($this->pegawaiId);
            $pegawai->update([
                'nama' => $this->nama,
                'telepon' => $this->telepon,
                'alamat' => $this->alamat,
                'birth' => $this->birth,
                'salary' => $this->salary,
                'posisi_id' => $this->posisi_id,
                'image' => $imagePath,
                'is_active' => $this->is_active,
            ]);
        } else {
            modelPegawai::create([
                'nama' => $this->nama,
                'telepon' => $this->telepon,
                'alamat' => $this->alamat,
                'birth' => $this->birth,
                'salary' => $this->salary,
                'posisi_id' => $this->posisi_id,
                'image' => $imagePath,
                'is_active' => $this->is_active,
            ]);
        }

        $this->resetForm();
        $this->dispatch('showToast', message: 'Data berhasil disimpan!', type: 'success', title: 'Success');
    }

    public function edit($id)
    {
        $pegawai = modelPegawai::findOrFail($id);
        $this->pegawaiId = $pegawai->id;
        $this->nama = $pegawai->nama;
        $this->telepon = $pegawai->telepon;
        $this->alamat = $pegawai->alamat;
        $this->birth = $pegawai->birth;
        $this->salary = $pegawai->salary;
        $this->posisi_id = $pegawai->posisi_id;
        $this->oldImage = $pegawai->image;
        $this->is_active = $pegawai->is_active == 1;
        $this->modalPegawai = true;
    }

    public function openModal($id = null)
    {
        $id ? $this->edit($id) : $this->resetForm();
        $this->posisis = Posisi::all();
        $this->modalPegawai = true;
    }

    public function konfirmasiHapus($id)
    {
        $this->pegawaiId = $id;
        $this->modalConfirmDelete = true;
    }

    protected $listeners = [
        'pegawaiDihapus' => 'render', // Akan trigger render ulang saat event ini dipanggil
    ];
    public function hapus()
    {
        $pegawai = modelPegawai::find($this->pegawaiId);

        if ($pegawai?->image && FacadesStorage::disk('public')->exists($pegawai->image)) {
            FacadesStorage::disk('public')->delete($pegawai->image);
        }
        $pegawai?->delete();
        $this->modalConfirmDelete = false;
        // Trigger render ulang komponen dengan emit event
        $this->dispatch('pegawaiDihapus');
        $this->dispatch('showToast', message: 'Data berhasil dihapus!', type: 'success', title: 'Success');
    }



    public function resetForm()
    {
        $this->pegawaiId = null;
        $this->nama = '';
        $this->telepon = '';
        $this->alamat = '';
        $this->birth = '';
        $this->salary = '';
        $this->posisi_id = '';
        $this->image = null;
        $this->oldImage = null;
        $this->is_active = true;
        $this->modalPegawai = false;
    }
    public $pegawaiPagination;
    public function render()
    {
        $query = modelPegawai::query();
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('telepon', 'like', '%' . $this->search . '%');
            });
        }
        $pegawai = $query->latest()->paginate(10);
        return view('livewire.admin.pegawai', ['pegawai' => $pegawai]);
    }
}
