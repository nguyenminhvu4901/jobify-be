<?php

namespace Database\Seeders\Users;

use App\Entities\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'full_name' => 'User One',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'phone_number' => '0912345678'
        ]);
    }
}
