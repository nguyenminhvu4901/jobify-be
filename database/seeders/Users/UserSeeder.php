<?php

namespace Database\Seeders\Users;

use App\Models\Users\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        User::create([
            'full_name' => 'User One',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'phone' => '0912345678',
        ]);
    }
}