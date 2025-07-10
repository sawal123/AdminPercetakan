<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bahans')->insert([
            [
                'nama' => 'MMT',
                'deskripsi' => 'Bahan MMT cocok untuk spanduk outdoor dan indoor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sticker',
                'deskripsi' => 'Bahan Sticker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vinyl',
                'deskripsi' => 'Bahan vinyl tahan air dan sering digunakan untuk stiker atau label.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Art Paper',
                'deskripsi' => 'Kertas halus dan mengkilap, cocok untuk brosur dan katalog.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
