<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $salesIds = [2, 6, 13];

        for ($i = 0; $i < 10; $i++) {
            Pelanggan::create([
                'pegawais_id' => $salesIds[array_rand($salesIds)], // Ambil acak dari 2, 6, 13
                'nama' => 'Pelanggan ' . ($i + 1),
                'telepon' => '08' . rand(1111111111, 9999999999),
                'alamat' => 'Jl. Contoh No. ' . rand(1, 100),
                'seller'      => (bool)rand(0, 1), // nilai boolean: true/false
            ]);
        }
    }
}
