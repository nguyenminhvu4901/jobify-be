<?php

namespace Database\Seeders;

use Database\Seeders\DefaultStatuses\DefaultStatusSeeder;
use Database\Seeders\Users\UserSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DefaultStatusSeeder::class,
            UserSeeder::class
        ]);
    }
}
