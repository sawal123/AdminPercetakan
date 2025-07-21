<?php

namespace App\Livewire\Admin;

use App\Models\Bahan;
use App\Models\Barang as ModelsBarang;
use App\Models\Pelanggan;
use Livewire\Component;
use Livewire\WithPagination;

class Barang extends Component
{
    use WithPagination;

    public $dataSatuan = ['Meter', 'Pcs', 'Roll', 'Bungkus', 'Kotak'];
    public $modalBarang = false;
    public $modalConfirmDelete = false;

    public $dataBahan;
    public $kode, $barang, $bahan, $ukuran, $satuan = null, $stok, $harga, $harga_seller;

    public $barangId = null; // Untuk edit
    public $barangIdDelete = null; // Untuk delete

    public $search = ''; // Tambahan untuk fitur search

    protected $paginationTheme = 'bootstrap'; // Pakai bootstrap pagination

    protected $listeners = [
        'barangSimpan' => 'render',
        'barangHapus' => 'render',
    ];


    protected $rules = [
        'kode' => 'required|string|max:10',
        'barang' => 'required|string|max:255',
        'bahan' => 'required|exists:bahans,id',
        'ukuran' => 'required|string|max:100',
        'satuan' => 'required|string',
        'stok' => 'required|integer|min:0',
        'harga' => 'required|numeric|min:0',
        'harga_seller' => 'required|numeric|min:0',
    ];

    protected $queryString = ['search']; // Search masuk ke URL otomatis

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman 1 saat search berubah
    }

    public function mount() {}

    public function modalB()
    {
        $this->resetForm();
        $this->modalBarang = true;
    }

    public function bukaModal($id = null)
    {
        $this->resetValidation();
        $this->resetForm();

        if ($id) {
            $barang = ModelsBarang::findOrFail($id);
            $this->barangId = $barang->id;
            $this->kode = $barang->kode;
            $this->barang = $barang->nama;
            $this->bahan = $barang->bahan_id;
            $this->ukuran = $barang->ukuran;
            $this->satuan = $barang->satuan;
            $this->stok = $barang->stok;
            $this->harga = $barang->harga;
            $this->harga_seller = $barang->harga_seller;
        }

        $this->modalBarang = true;
    }

    public function simpan()
    {
        $this->validate();

        ModelsBarang::updateOrCreate(
            ['id' => $this->barangId],
            [
                'kode' => $this->kode,
                'nama' => $this->barang,
                'bahan_id' => $this->bahan,
                'ukuran' => $this->ukuran,
                'satuan' => $this->satuan,
                'stok' => $this->stok,
                'harga' => $this->harga,
                'harga_seller' => $this->harga_seller,
            ]
        );
        $this->dispatch('barangSimpan');
        $notif =  $this->barangId ? 'Barang berhasil diperbarui.' : 'Barang berhasil ditambahkan.';
        $message = [$notif, 'success', 'Success'];
        $this->dispatch('showToast', message: $message[0], type: $message[1], title: $message[2]);

        $this->modalBarang = false;
        $this->resetForm();
    }

    public function konfirmasiHapus($id)
    {
        $this->barangIdDelete = $id;
        $this->modalConfirmDelete = true;
    }

    public function hapus()
    {
        if ($this->barangIdDelete) {
            ModelsBarang::findOrFail($this->barangIdDelete)->delete();
            $this->dispatch('barangHapus');
            $message = ['Barang berhasil dihapus.', 'success', 'Success'];
            $this->dispatch('showToast', message: $message[0], type: $message[1], title: $message[2]);
        }
        $this->modalConfirmDelete = false;
        $this->barangIdDelete = null;
    }

    private function resetForm()
    {
        $this->reset(['barangId', 'kode', 'barang', 'bahan', 'ukuran', 'satuan', 'stok', 'harga', 'harga_seller']);
    }

    public function render()
    {
        $barang = ModelsBarang::with('bahan')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('kode', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $this->dataBahan = Bahan::all();


        return view('livewire.admin.barang', [
            'dataBarang' => $barang,

        ]);
    }
}
