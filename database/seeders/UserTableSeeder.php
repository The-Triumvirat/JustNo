<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            // Admin 
            [
                'name' => 'magnus',
                'username' => 'magnus',
                'email' => 'magnus@example.com',
                'password' => Hash::make('robert.123'),
                'role' => 'admin',
                'is_active' => true,
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('robert.123'),
                'role' => 'admin',
                'is_active' => true,
            ],
            // User Data 
            [
                'name' => 'robert',
                'username' => 'robert',
                'email' => 'robert@example.com',
                'password' => Hash::make('robert.123'),
                'role' => 'user',
                'is_active' => true,
            ],
        ]);
    }
}
