<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache peran
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Roles
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $rolePeternak = Role::firstOrCreate(['name' => 'Peternak']);
        $roleDistributor = Role::firstOrCreate(['name' => 'Distributor']);
        $rolePedagang = Role::firstOrCreate(['name' => 'Pedagang']);

        // Buat User Admin
        User::firstOrCreate(
            ['email' => 'admin@ayam.com'],
            ['name' => 'Admin Panel', 'password' => Hash::make('password')]
        )->assignRole($roleAdmin);

        // Buat User Peternak
        User::firstOrCreate(
            ['email' => 'peternak@ayam.com'],
            ['name' => 'Peternak Test', 'password' => Hash::make('password')]
        )->assignRole($rolePeternak);

        // Buat User Distributor
        User::firstOrCreate(
            ['email' => 'distributor@ayam.com'],
            ['name' => 'Distributor Test', 'password' => Hash::make('password')]
        )->assignRole($roleDistributor);

        // Buat User Pedagang
        User::firstOrCreate(
            ['email' => 'pedagang1@ayam.com'],
            ['name' => 'Pedagang Test 1', 'password' => Hash::make('password')]
        )->assignRole($rolePedagang);
        User::firstOrCreate(
            ['email' => 'pedagang2@ayam.com'],
            ['name' => 'Pedagang Test 2', 'password' => Hash::make('password')]
        )->assignRole($rolePedagang);
    }
}
