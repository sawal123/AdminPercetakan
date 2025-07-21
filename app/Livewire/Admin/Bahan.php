<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bahan as ModelsBahan;

class Bahan extends Component
{
    use WithPagination;
    public $nama, $deskripsi;
    public $openModal = false;
    public $confirmingDelete = false;
    public $bahan_id;
    public $isEdit = false;
    public $deleteId = null;
    public $search = '';
    protected $listeners = [
        'bahanSimpan' => 'render',
        'bahanHapus' => 'render',
    ];
    public function modal()
    {
        $this->resetForm();
        $this->openModal = true;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function simpan()
    {
        $this->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string'
        ]);

        ModelsBahan::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);
        $this->dispatch('bahanSimpan');
        $message = $this->bahan_id ? 'Bahan berhasil diperbarui.' : 'Bahan berhasil ditambahkan.';
        $type = 'success';
        $title = 'Success';
        $this->dispatch('showToast', message: $message, type: $type, title: $title);
        $this->resetForm();
    }

    public function edit($id)
    {
        $bahan = ModelsBahan::findOrFail($id);
        $this->bahan_id = $bahan->id;
        $this->nama = $bahan->nama;
        $this->deskripsi = $bahan->deskripsi;
        $this->isEdit = true;
        $this->openModal = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string'
        ]);

        $bahan = ModelsBahan::findOrFail($this->bahan_id);
        $bahan->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);
        // session()->flash('message', 'Bahan berhasil diperbarui.');
        $message = 'Bahan berhasil diperbarui.';
        $type = 'success';
        $title = 'Update';
        $this->dispatch('showToast', message: $message, type: $type, title: $title);
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        ModelsBahan::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        $this->deleteId = null;
        $this->dispatch('bahanHapus');
        $message = 'Bahan berhasil dihapus.';
        $type = 'success';
        $title = 'Delete';
        $this->dispatch('showToast', message: $message, type: $type, title: $title);
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->deskripsi = '';
        $this->bahan_id = null;
        $this->isEdit = false;
        $this->openModal = false;
    }

    public function render()
    {
        // $data = ModelsBahan::latest()->get();
        $data = ModelsBahan::query()
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('livewire.admin.bahan', ['data' => $data]);
    }
}
