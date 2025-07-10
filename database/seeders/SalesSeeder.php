<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data = [
            [
                'nama' => 'Andi Pratama',
                'telepon' => '081234567890',
                'is_active'=> 1
            ],
            [
                'nama' => 'Rina Kusuma',
                'telepon' => '082345678901',
                'is_active'=> 1
            ],
            [
                'nama' => 'Budi Santoso',
                'telepon' => '083456789012',
                'is_active'=> 1
            ],
        ];

        foreach ($data as $item) {
            Sales::create($item);
        }
    }
}
