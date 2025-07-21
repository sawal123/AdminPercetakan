<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $kasir = User::create([
            'name' => 'Kasir Satu',
            'email' => 'kasir@example.com',
            'password' => Hash::make('password'),
        ]);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'kasir']);
        $admin->assignRole('admin');
        $kasir->assignRole('kasir');
    }
}
