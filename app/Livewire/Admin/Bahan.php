<?php

namespace App\Livewire\Admin;

use App\Models\Bahan as ModelsBahan;
use Livewire\Component;

class Bahan extends Component
{
    public $nama, $deskripsi;
    public $openModal = false;
    public $confirmingDelete = false;
    public $bahan_id;
    public $isEdit = false;
    public $deleteId = null;

    public function modal()
    {
        $this->resetForm();
        $this->openModal = true;
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
        session()->flash('message', $this->barangId ? 'Bahan berhasil diperbarui.' : 'Bahan berhasil ditambahkan.');
        $this->dispatch('showToast');
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
        session()->flash('message', 'Bahan berhasil dihapus.');
        $this->dispatch('showToast');
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

        $this->dispatch('showToast');
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
        $data = ModelsBahan::latest()->get();
        return view('livewire.admin.bahan', ['data' => $data]);
    }
}
