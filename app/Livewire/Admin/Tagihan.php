<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tagihan as ModelsTagihan;

class Tagihan extends Component
{
    use WithPagination;
    public $count, $deskripsi, $search = '';
    public $modalConfirmDelete = false;
    public $tagihanToDeleteId = null;
    public function updated()
    {
        $this->count++;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->tagihanToDeleteId = $id;
        $this->modalConfirmDelete = true;
    }


    public function hapus()
    {
        $tagihanDelete = ModelsTagihan::find($this->tagihanToDeleteId);

        if ($tagihanDelete) {
            $tagihanDelete->delete();
            session()->flash('message', 'Tagihan berhasil dihapus.');
        } else {
            session()->flash('message', 'Tagihan tidak ditemukan.');
        }
        $this->dispatch('showToast');
        $this->modalConfirmDelete = false;
        $this->tagihanToDeleteId = null;
    }

    public function lunas($id)
    {
        $tagihanLunas = ModelsTagihan::find($id);

        if (!$tagihanLunas) {
            session()->flash('error', 'Tagihan tidak ditemukan!');
            return;
        }

        $message = '';
        if ($tagihanLunas->status == 1) {
            $tagihanLunas->status = 0;
            $message = "Tagihan Belum Lunas!";
        } else {
            $tagihanLunas->status = 1;
            $message = "Tagihan Lunas!";
        }

        $tagihanLunas->save();

        // session()->flash('message', $message);
        $this->dispatch('showToast', message: $message);
    }

    public function mount() {}
    public function render()
    {
        $tagihan = ModelsTagihan::query()
            ->where('invoice', 'like', '%' . $this->search . '%')
            ->orWhereHas('pelanggan', function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
        return view('livewire.admin.tagihan', ['tagihan' => $tagihan]);
    }
}
