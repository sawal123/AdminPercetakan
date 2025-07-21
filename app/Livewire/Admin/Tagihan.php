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
            $message = 'Tagihan dihapus.';
            $type = 'success';
        } else {
            $message = 'Tagihan tidak ditemukan.';
            $type = 'error';
        }

        $title = 'Success';
        $this->dispatch('showToast', message: $message, type: $type, title: $title);
        $this->modalConfirmDelete = false;
        $this->tagihanToDeleteId = null;
    }

    public function lunas($id)
    {
        $tagihanLunas = ModelsTagihan::find($id);

        if (!$tagihanLunas) {
            $message = "Tagihan Tidak ditemukan";
            return;
        }

        $message = '';
        if ($tagihanLunas->status == 1) {
            $tagihanLunas->status = 0;
              $message = ['Tagihan Belum Lunas!', 'warning', 'Warning'];
        } else {
            $tagihanLunas->status = 1;
            $message = ['Tagihan Lunas!', 'success', 'success'];
        }

        $tagihanLunas->save();


        $this->dispatch('showToast', message: $message[0], type: $message[1], title: $message[2]);
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
