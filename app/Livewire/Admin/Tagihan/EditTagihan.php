<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Barang;
use App\Models\Tagihan;
use Livewire\Component;
use App\Models\PesananItem;

class EditTagihan extends Component
{
    public string $invoice;
    public $items;
    public $tagihan_id;

    public $modalConfirmDelete = false;
    public $indexToDelete = null;

    public $pesananItems = [];
    public function confirmDelete($index)
    {
        $this->indexToDelete = $index;
        $this->modalConfirmDelete = true;
    }

    private function getHargaDasar($barangId)
    {
        $barang = Barang::find($barangId);
        $tagihan = Tagihan::where('invoice', $this->invoice)->first();
        if ($tagihan->pelanggan->seller) {
            return $barang ? $barang->harga_seller : 0;
        } else {
            return $barang ? $barang->harga : 0;
        }
    }


    public function updatePesananItem($index)
    {
        $item = $this->pesananItems[$index] ?? null;

        if (!$item) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        $barang = Barang::where('nama', $item['barang_nama'])->first();

        if (!$barang) {
            session()->flash('error', 'Barang tidak ditemukan.');
            return;
        }

        $pesananItem = PesananItem::updateOrCreate(
            [
                'tagihan_id' => $this->tagihan_id,
                'barang_id' => $barang->id,
            ],
            [
                'deskripsi' => $item['deskripsi'] ?? null,
                'panjang' => $item['panjang'] ?? null,
                'lebar' => $item['lebar'] ?? null,
                'jumlah' => $item['jumlah'] ?? 1,
                'harga_satuan' => $item['harga_satuan'] ?? 0,
                'subtotal' => $item['subtotal'] ?? 0,
            ]
        );

        // ✅ Tambahkan bagian ini: hitung ulang total tagihan
        $totalBaru = PesananItem::where('tagihan_id', $this->tagihan_id)->sum('subtotal');

        Tagihan::where('id', $this->tagihan_id)->update([
            'total' => $totalBaru
        ]);

        session()->flash('message', 'Item berhasil diperbarui.');
        $this->dispatch('showToast');
    }


    public function hapus()
    {
        $index = $this->indexToDelete;


        if (!isset($this->pesananItems[$index])) {
            $this->modalConfirmDelete = false;
            session()->flash('message', 'Item tidak ditemukan');
            $this->dispatch('showToast');
            return;
        }

        $item = $this->pesananItems[$index];

        $itemDelete = PesananItem::find($item['items_id']);
        $itemDelete->delete();



        unset($this->pesananItems[$index]);
        $this->pesananItems = array_values($this->pesananItems);

        $this->modalConfirmDelete = false;
        $this->indexToDelete = null;

        session()->flash('message', 'Item berhasil dihapus.');
        $this->dispatch('showToast');
    }






    public function updatedPesananItems($value, $key)
    {
        // Format key: "index.field" → contoh: "0.jumlah"
        [$index, $field] = explode('.', $key);

        if (!isset($this->pesananItems[$index])) return;

        $item = $this->pesananItems[$index];

        // Ambil harga dasar dari tabel barang
        $hargaDasar = $this->getHargaDasar($item['barang_id'] ?? null);

        $jumlah = intval($item['jumlah'] ?? 1);
        $hargaSatuan = 0;
        $subtotal = 0;

        if (($item['satuan'] ?? '') === 'Meter') {
            $panjang = floatval($item['panjang'] ?? 0);
            $lebar = floatval($item['lebar'] ?? 0);
            $luas = $panjang * $lebar;

            $hargaSatuan = round($luas * $hargaDasar, 2);
        } else {
            // satuan bukan Meter
            $hargaSatuan = round($hargaDasar, 2);
        }

        $subtotal = round($jumlah * $hargaSatuan, 2);

        // Update kembali
        $this->pesananItems[$index]['harga_satuan'] = $hargaSatuan;
        $this->pesananItems[$index]['subtotal'] = $subtotal;
    }



    public function mount()
    {
        $tagihan = Tagihan::where('invoice', $this->invoice)->first();
        $this->tagihan_id = $tagihan->id;
        $this->pesananItems = $tagihan->pesananItems->map(function ($item) {
            return [
                'items_id' => $item->id,
                'barang_id' => $item->barang->id,
                'barang_nama' => $item->barang->nama,
                'satuan' => $item->barang->satuan,
                'deskripsi' => $item->deskripsi,
                'panjang' => $item->panjang,
                'lebar' => $item->lebar,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $item->harga_satuan,
                'subtotal' => $item->subtotal,
            ];
        })->toArray();;
    }
    public function render()
    {
        return view('livewire.admin.tagihan.edit-tagihan');
    }
}
