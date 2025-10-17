<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Tambahkan user lain jika diperlukan
        // User::create([
        //     'name' => 'User Test',
        //     'email' => 'user@test.com',
        //     'password' => Hash::make('userpassword'),
        //     'email_verified_at' => now(),
        // ]);
    }
}