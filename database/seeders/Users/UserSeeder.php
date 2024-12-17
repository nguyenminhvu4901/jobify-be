<?php

namespace Database\Seeders\Users;

use App\Enums\DefaultRole;
use App\Models\User;
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

        $userAdmin = User::create([
            'full_name' => 'User Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin@12'),
            'phone_number' => '0912345678',
            'current_role' => DefaultRole::ADMIN
        ]);

        $userAdmin->syncRoles(DefaultRole::ADMIN);
    }
}
