<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pandaoni.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '081234567890',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@pandaoni.com'],
            [
                'name' => 'Sam Pelanggan',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => '081298765432',
            ]
        );
    }
}
