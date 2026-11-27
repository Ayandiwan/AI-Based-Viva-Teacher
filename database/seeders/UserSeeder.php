<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin@123'),
            'role' => 'admin',
        ]);

        // Teacher
        User::create([
            'name' => 'Ad',
            'email' => 'ad@gmail.com',
            'password' => Hash::make('Ad@123'),
            'role' => 'teacher',
        ]);

        // Student
        User::create([
            'name' => 'Ayan',
            'email' => 'ayandiwan8769@gmail.com',
            'password' => Hash::make('Ayan@123'),
            'role' => 'student',
        ]);
    }
}

