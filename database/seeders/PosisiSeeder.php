<?php

namespace Database\Seeders;

use App\Models\Posisi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $posisiList = [
            'Produksi',
            'Sales',
            'Designer',
            'Owner',
            'Cleaning Service',
            'Admin',
            'Finance',
        ];

        foreach ($posisiList as $nama) {
            Posisi::create([
                'nama_posisi' => $nama,
            ]);
        }
    }
}
