<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Buat Permission
        Permission::create(['name' => 'kasir']);
        Permission::create(['name' => 'admin']);

        // Buat Role
        $admin = Role::create(['name' => 'admin']);
        $kasir = Role::create(['name' => 'kasir']);

        // Beri permission ke role
        $admin->givePermissionTo(['kasir', 'admin']);
        $kasir->givePermissionTo(['kasir']);

    }
}
