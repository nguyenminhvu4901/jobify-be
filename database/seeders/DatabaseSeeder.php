<?php

namespace Database\Seeders;

use Database\Seeders\Address\DistrictSeeder;
use Database\Seeders\CompanyScales\CompanyScaleSeeder;
use Database\Seeders\DefaultData\DefaultContentTypeSeeder;
use Database\Seeders\DefaultData\DefaultGenderSeeder;
use Database\Seeders\DefaultData\DefaultRateSeeder;
use Database\Seeders\DefaultData\DefaultStatusSeeder;
use Database\Seeders\Roles\RoleSeeder;
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
            DefaultGenderSeeder::class,
            DefaultRateSeeder::class,
            DefaultContentTypeSeeder::class,
            CompanyScaleSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);
    }
}
