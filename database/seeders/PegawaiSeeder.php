<?php

namespace Database\Seeders;

use App\Models\Posisi;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PegawaiSeeder extends Seeder
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
                'alamat' => 'Jl. Merdeka No.1',
                'birth' => '1990-01-01',
                'salary' => 5000000,
                'posisi_id' => 1, // Produksi
                'is_active' => 1
            ],
            [
                'nama' => 'Rina Kusuma',
                'telepon' => '082345678901',
                'alamat' => 'Jl. Sudirman No.2',
                'birth' => '1992-02-02',
                'salary' => 6000000,
                'posisi_id' => 2, // Sales
                'is_active' => 1
            ],
            [
                'nama' => 'Budi Santoso',
                'telepon' => '083456789012',
                'alamat' => 'Jl. Thamrin No.3',
                'birth' => '1988-03-03',
                'salary' => 5500000,
                'posisi_id' => 3, // Designer
                'is_active' => 1
            ],
            [
                'nama' => 'Sari Lestari',
                'telepon' => '084567890123',
                'alamat' => 'Jl. Gatot Subroto No.4',
                'birth' => '1991-04-04',
                'salary' => 5200000,
                'posisi_id' => 7, // Finance
                'is_active' => 1
            ],
            [
                'nama' => 'Dedi Haryanto',
                'telepon' => '085678901234',
                'alamat' => 'Jl. Asia Afrika No.5',
                'birth' => '1987-05-05',
                'salary' => 5800000,
                'posisi_id' => 1, // Produksi
                'is_active' => 1
            ],
            [
                'nama' => 'Nina Fitriani',
                'telepon' => '086789012345',
                'alamat' => 'Jl. Ahmad Yani No.6',
                'birth' => '1993-06-06',
                'salary' => 6100000,
                'posisi_id' => 2, // Sales
                'is_active' => 1
            ],
            [
                'nama' => 'Rahmat Gunawan',
                'telepon' => '087890123456',
                'alamat' => 'Jl. Pemuda No.7',
                'birth' => '1990-07-07',
                'salary' => 5700000,
                'posisi_id' => 1, // Produksi
                'is_active' => 1
            ],
            [
                'nama' => 'Lisa Mariana',
                'telepon' => '088901234567',
                'alamat' => 'Jl. Veteran No.8',
                'birth' => '1989-08-08',
                'salary' => 6000000,
                'posisi_id' => 6, // Admin
                'is_active' => 1
            ],
            [
                'nama' => 'Fajar Nugroho',
                'telepon' => '089012345678',
                'alamat' => 'Jl. Diponegoro No.9',
                'birth' => '1986-09-09',
                'salary' => 5900000,
                'posisi_id' => 1, // Produksi
                'is_active' => 1
            ],
            [
                'nama' => 'Indah Puspita',
                'telepon' => '080123456789',
                'alamat' => 'Jl. Juanda No.10',
                'birth' => '1994-10-10',
                'salary' => 6200000,
                'posisi_id' => 3, // Designer
                'is_active' => 1
            ],
            [
                'nama' => 'Dian Putra',
                'telepon' => '081345678901',
                'alamat' => 'Jl. Letjen Sutoyo No.11',
                'birth' => '1985-11-11',
                'salary' => 6300000,
                'posisi_id' => 4, // Owner
                'is_active' => 1
            ],
            [
                'nama' => 'Mira Santika',
                'telepon' => '082456789012',
                'alamat' => 'Jl. Kalibata No.12',
                'birth' => '1995-12-12',
                'salary' => 5400000,
                'posisi_id' => 6, // Admin
                'is_active' => 1
            ],
            [
                'nama' => 'Yoga Ramadhan',
                'telepon' => '083567890123',
                'alamat' => 'Jl. Kemang No.13',
                'birth' => '1990-03-15',
                'salary' => 5600000,
                'posisi_id' => 2, // Sales
                'is_active' => 1
            ],
            [
                'nama' => 'Ayu Wulandari',
                'telepon' => '084678901234',
                'alamat' => 'Jl. Ciledug No.14',
                'birth' => '1996-06-18',
                'salary' => 5100000,
                'posisi_id' => 7, // Finance
                'is_active' => 1
            ],
            [
                'nama' => 'Galih Saputra',
                'telepon' => '085789012345',
                'alamat' => 'Jl. BSD Raya No.15',
                'birth' => '1984-04-22',
                'salary' => 6400000,
                'posisi_id' => 5, // Cleaning Service
                'is_active' => 1
            ],
        ];


        foreach ($data as $item) {
            // $posisi = Posisi::where('nama_posisi', $item['posisi'])->first();

            Pegawai::create([
                'nama' => $item['nama'],
                'telepon' => $item['telepon'],
                'alamat' => $item['alamat'],
                'birth' => $item['birth'],
                'salary' => $item['salary'],
                'posisi_id' =>  $item['posisi_id'],
                'is_active' => $item['is_active'],
            ]);
        }
    }
}
