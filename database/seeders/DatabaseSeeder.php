<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Admin Default
        User::create([
            'name' => 'Admin kepegawaian',
            'email' => 'adminsispeg@sispeg.com',
            'password' => Hash::make('adminsispeg'), // Passwordnya
        ]);
    }
}