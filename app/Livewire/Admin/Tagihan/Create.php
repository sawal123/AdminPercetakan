<?php

namespace App\Livewire\Admin\Tagihan;

use App\Models\Sales;
use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\Tagihan;
use Livewire\Component;
use App\Models\Pelanggan;
use App\Models\PesananItem;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Create extends Component
{
    use WithPagination;

    public $items = [];
    public $maxItems = 5;
    public $pelanggan_id = 0;
    public $tanggal = null;
    public $invoice = null;
    public $seller = false; // Status pelanggan apakah seller atau bukan
    public $count;
    public $disabled = "disabled";
    public $inputDisabled = "";
    public $sales_id;


    public $nama_barang;
    public $deskripsi;
    public $panjang;
    public $lebar;
    public $jumlah = 1;
    public $harga_satuan = 0;
    public $subtotal = 0;

    public $tagihan_id = null;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->invoice = "Inv-" . Str::upper(Str::random(8));
    }

    public function updatedPelangganId($id)
    {
        // Cari pelanggan berdasarkan ID
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) {
            $this->seller = $pelanggan->seller;  // Menetapkan apakah pelanggan adalah seller
            $this->disabled = '';  // Mengaktifkan input jika pelanggan dipilih
        }
        $this->updateHargaSatuan();
    }
    public function updatedNamaBarang($id)
    {
        $barang = Barang::find($id);
        $this->updateHargaSatuan();
    }
    private function updateHargaSatuan()
    {
        if (isset($this->nama_barang)) {
            $barang = Barang::find($this->nama_barang);

            if ($barang) {
                // Ambil harga sesuai status seller
                $harga_dasar = $this->seller ? $barang->harga_seller : $barang->harga;

                if ($barang->satuan === "Meter") {
                    $this->inputDisabled = '';

                    // Hitung harga_satuan berdasarkan luas
                    $luas = floatval($this->panjang) * floatval($this->lebar);
                    $this->harga_satuan = round($luas * $harga_dasar, 2);
                } else {
                    $this->inputDisabled = 'disabled';
                    $this->harga_satuan = $harga_dasar;
                }

                // Perbarui subtotal
                $this->updatedJumlah();
            }
        }
    }

    public function updatedPanjang()
    {
        $this->updateHargaSatuan();
    }

    public function updatedLebar()
    {
        $this->updateHargaSatuan();
    }

    public function getSavedItemsProperty()
    {
        if (!$this->tagihan_id) return collect();
        return PesananItem::where('tagihan_id', $this->tagihan_id)->get();
    }



    public function updatedJumlah()
    {
        $this->subtotal =  round($this->jumlah * $this->harga_satuan, 2);
    }

    public function simpan()
    {
        // Validasi input yang diperlukan
        $this->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'nama_barang' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Cek apakah tagihan sudah dibuat
        if (!$this->tagihan_id) {
            $tagihan = Tagihan::create([
                'pelanggan_id' => $this->pelanggan_id,
                'tanggal' => $this->tanggal,
                'invoice' => $this->invoice,
                'status' => 0,
            ]);
            $this->tagihan_id = $tagihan->id;
        } else {
            $tagihan = Tagihan::find($this->tagihan_id);
            if ($this->pelanggan_id != $tagihan->pelanggan_id) {
                $message = 'Pelanggan tidak boleh diubah setelah tagihan dibuat.';
                $type = 'error';
                $title = 'Success';
                $this->dispatch('showToast', message: $message, type: $type, title: $title);
                return;
            }
        }
        // Cek jumlah item yang sudah tersimpan
        if ($tagihan->pesananItems()->count() >= $this->maxItems) {
            $message = ['Maksimal 5 Item Setiap Invoice', 'info', 'Info'];
            $this->dispatch('showToast', message: $message[0], type: $message[1], title: $message[2]);
            return;
        }
        // Simpan item
        PesananItem::create([
            'tagihan_id' => $this->tagihan_id,
            'barang_id' => $this->nama_barang,
            'deskripsi' => $this->deskripsi,
            'panjang' => $this->panjang,
            'lebar' => $this->lebar,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'subtotal' => $this->subtotal,
        ]);
        // Update total di tagihan
        $tagihan->total = $tagihan->pesananItems()->sum('subtotal');
        $tagihan->save();

        // Reset input item (bukan tagihan)
        $this->reset(['nama_barang', 'deskripsi', 'panjang', 'lebar', 'jumlah', 'harga_satuan', 'subtotal']);
        $message = ['Item berhasil disimpan.', 'success', 'Success'];
        $this->dispatch('showToast', message: $message[0], type: $message[1], title: $message[2]);
    }
    


    public function render()
    {

        // error_reporting(0);
        return view('livewire.admin.tagihan.create', [
            'barangs' => Barang::all(), // Ambil semua barang untuk dropdown
            'pelanggan' => Pelanggan::all(),
            'savedItems' => $this->savedItems, // Tambah ini
            'dataPelanggan' => Pelanggan::find($this->pelanggan_id),
            'sales' => Pegawai::where('is_active', 1)->where('posisi_id', 2)->get()
        ]);
    }
}
