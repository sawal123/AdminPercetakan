<?php

namespace App\Livewire\Admin;

use App\Models\Sales;
use Livewire\Component;
use Livewire\WithPagination;
// Paginator::useBootstrap();
use App\Models\Pelanggan as ModelsPelanggan;

class Pelanggan extends Component
{
    use WithPagination;
    
    public $nama, $telepon, $alamat, $seller, $sales_id;
    public $modalPelanggan = false;
    public $pelangganId, $modalConfirmDelete = false, $deleteId, $search;

    // Fungsi untuk membuka modal Create/Edit
    public function openModal($pelangganId = null)
    {
        // dd($pelangganId);
        if ($pelangganId) {
            $this->pelangganId = $pelangganId;
            $pelanggan = ModelsPelanggan::find($pelangganId);
            $this->sales_id = $pelanggan->sales_id;
            $this->nama = $pelanggan->nama;
            $this->telepon = $pelanggan->telepon;
            $this->alamat = $pelanggan->alamat;
            $this->seller = (bool) $pelanggan->seller;
        } else {
            $this->reset();
        }

        $this->modalPelanggan = true;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    // Fungsi untuk menyimpan atau memperbarui data pelanggan
    public function simpan()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|numeric|digits_between:10,15',
            'alamat' => 'nullable|string',
            'seller' => 'nullable|boolean',
        ]);

        if ($this->pelangganId) {
            // Update data pelanggan
            $pelanggan = ModelsPelanggan::find($this->pelangganId);
            $pelanggan->update([
                'sales_id' => $this->sales_id,
                'nama' => $this->nama,
                'telepon' => $this->telepon,
                'alamat' => $this->alamat,
                'seller' => $this->seller,
            ]);
        } else {
            // Menyimpan data pelanggan baru
            ModelsPelanggan::create([
                'sales_id' => $this->sales_id,
                'nama' => $this->nama,
                'telepon' => $this->telepon,
                'alamat' => $this->alamat,
                'seller' => $this->seller,
            ]);
        }

        $this->reset();
        $this->modalPelanggan = false;
        session()->flash('message', $this->pelangganId ? 'Pelanggan berhasil diperbarui.' : 'Pelanggan berhasil disimpan.');
        $this->dispatch('showToast');
    }

    // Fungsi untuk membuka modal konfirmasi delete
    public function konfirmasiHapus($id)
    {
        $this->deleteId = $id;
        $this->modalConfirmDelete = true;
    }

    // Fungsi untuk menghapus data pelanggan
    public function hapus()
    {
        $pelanggan = ModelsPelanggan::find($this->deleteId);
        if ($pelanggan) {
            $pelanggan->delete();
            session()->flash('message', 'Pelanggan berhasil dihapus.');
            $this->dispatch('showToast');
        }
        $this->modalConfirmDelete = false;
    }


    public function render()
    {
        $sales = Sales::where('is_active', 1)->get();
        $pelanggan = ModelsPelanggan::query()->where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('alamat', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.pelanggan', ['pelanggan' => $pelanggan, 'sales' => $sales]);
    }
}
