<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Tagihan;
use Livewire\Component;

class ViewTagihan extends Component
{
    public string $invoice;
    public $dataPelanggan;
    public $savedItems;
    public $tanggal;

    public function mount($invoice)
    {
        $this->invoice = $invoice;

        // Ambil data tagihan
        $tagihan = Tagihan::with(['pelanggan', 'sales', 'pesananItems']) // sesuaikan relasi
            ->where('invoice', $invoice)
            ->firstOrFail();

        $this->dataPelanggan = $tagihan->pelanggan;
        $this->savedItems = $tagihan->pesananItems;
        // dd($this->savedItems);
        $this->tanggal = $tagihan->created_at->format('d-m-Y'); // format sesuai kebutuhan
    }

    public function render()
    {
        return view('livewire.admin.tagihan.view-tagihan');
    }
}
