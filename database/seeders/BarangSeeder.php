<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::updateOrCreate(
            ['kode' => 'BRG001'],
            [
                'nama' => 'Spanduk MMT 1x1',
                'bahan_id' => 1, // pastikan bahan dengan id 1 sudah ada (misal MMT)
                'ukuran' => '100x100 cm',
                'satuan' => 'Meter',
                'stok' => 100,
                'harga' => 15000,
                'harga_seller' => 13000,
            ]
        );

        Barang::updateOrCreate(
            ['kode' => 'BRG002'],
            [
                'nama' => 'Sticker Vinyl A3',
                'bahan_id' => 2, // pastikan bahan dengan id 2 sudah ada (misal Vinyl)
                'ukuran' => 'A3',
                'satuan' => 'Lembar',
                'stok' => 50,
                'harga' => 12000,
                'harga_seller' => 10000,
            ]
        );

        Barang::updateOrCreate(
            ['kode' => 'BRG003'],
            [
                'nama' => 'Brosur Art Paper',
                'bahan_id' => 3, // pastikan bahan dengan id 3 sudah ada (misal Art Paper)
                'ukuran' => 'A4',
                'satuan' => 'Lembar',
                'stok' => 200,
                'harga' => 1000,
                'harga_seller' => 800,
            ]
        );
    }
}
