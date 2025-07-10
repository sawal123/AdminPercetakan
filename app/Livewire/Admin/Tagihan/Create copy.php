<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Barang;
use App\Models\Tagihan;
use Livewire\Component;
use App\Models\Pelanggan;
use App\Models\PesananItem;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;

    public $items = [];
    public $maxItems = 5;
    public $pelanggan_id;
    public $tanggal = null;
    public $invoice = null;
    public $seller = false; // Status pelanggan apakah seller atau bukan

    public function mount()
    {
        $this->items[] = [
            'nama_barang' => '',
            'panjang' => '',
            'lebar' => '',
            'jumlah' => 1,
            'harga_satuan' => '',
            'subtotal' => 0,
        ];

        $this->tanggal = date('Y-m-d');
        $this->invoice = "Inv-" . Str::upper(Str::random(8));
    }


    // Fungsi untuk memeriksa apakah pelanggan adalah seller atau bukan
    public function updatedPelangganId($pelangganId)
    {
        $pelanggan = Pelanggan::find($pelangganId);
        $this->seller = $pelanggan ? $pelanggan->seller : false; // Menyimpan status seller/non-seller

        // Update harga satuan otomatis ketika pelanggan diubah
        foreach ($this->items as $index => $item) {
            $this->updateHargaSatuan($index);
        }
    }

    // Fungsi untuk mengupdate harga satuan sesuai status pelanggan
    public function updateHargaSatuan($index)
    {
        $item = $this->items[$index];
      
        if ($item['nama_barang']) {
            $barang = Barang::find($item['nama_barang']);
            if ($barang) {
                $this->items[$index]['harga_satuan'] = $this->seller ? $barang->harga_seller : $barang->harga;
                $this->calculateSubtotal($index);
            }
        }
    }

    public function updatedItems($index)
    {
        $item = $this->items[$index];
        // dd($item);
        if ($item['nama_barang']) {
            // Cari data barang berdasarkan id yang dipilih
            $barang = Barang::find($item['nama_barang']);

            if ($barang) {
                // Set harga satuan sesuai dengan status pelanggan
                $this->items[$index]['harga_satuan'] = $this->seller ? $barang->harga_seller : $barang->harga;
                $this->calculateSubtotal($index);  // Menghitung subtotal setelah harga satuan diperbarui
            }
        }
    }



    public function addItem()
    {
        if (count($this->items) < $this->maxItems) {
            $this->items[] = [
                'nama_barang' => '',
                'deskripsi' => '',
                'panjang' => '',
                'lebar' => '',
                'jumlah' => 1,
                'harga_satuan' => '',
                'subtotal' => 0,
            ];
        }
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex array
    }

    // Menghitung subtotal
    public function calculateSubtotal($index)
    {
        $item = $this->items[$index];
        $this->items[$index]['subtotal'] = $item['panjang'] * $item['lebar'] * $item['harga_satuan'] ?? $item['jumlah'] * $item['harga_satuan'];
    }

    public function store()
    {
        $validatedData = $this->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal' => 'required|date',
            'items' => 'required|array|max:5',
            'items.*.nama_barang' => 'required|string',
            'items.*.panjang' => 'nullable|numeric',
            'items.*.lebar' => 'nullable|numeric',
            'items.*.jumlah' => 'nullable|integer|min:1',
            'items.*.harga_satuan' => 'required|numeric',
            'items.*.subtotal' => 'required|numeric',
        ]);

        // Create Tagihan (Invoice)
        $tagihan = Tagihan::create([
            'pelanggan_id' => $this->pelanggan_id,
            'tanggal' => $this->tanggal,
            'total' => array_sum(array_column($this->items, 'subtotal')),
        ]);

        // Create each PesananItem
        foreach ($this->items as $item) {
            PesananItem::create([
                'pesanan_id' => $tagihan->id,
                'barang_id' => $item['nama_barang'],
                'panjang' => $item['panjang'],
                'lebar' => $item['lebar'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        session()->flash('message', 'Tagihan berhasil dibuat!');
        return redirect()->route('admin.tagihan.index');
    }

    public function render()
    {
        return view('livewire.admin.tagihan.create', [
            'barangs' => Barang::all(), // Ambil semua barang untuk dropdown
            'pelanggan' => Pelanggan::all()
        ]);
    }
}
