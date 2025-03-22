<?php

namespace Database\Seeders;

use Database\Seeders\BusinessSectors\BusinessSectorSeeder;
use Database\Seeders\CompanyScales\CompanyScaleSeeder;
use Database\Seeders\CompanyWorkingDays\CompanyWorkingDaySeeder;
use Database\Seeders\DefaultData\DefaultContentTypeSeeder;
use Database\Seeders\DefaultData\DefaultGenderSeeder;
use Database\Seeders\DefaultData\DefaultRateSeeder;
use Database\Seeders\DefaultData\DefaultStatusSeeder;
use Database\Seeders\OperationTypes\OperationTypeSeeder;
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
            CompanyWorkingDaySeeder::class,
            OperationTypeSeeder::class,
            BusinessSectorSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);
    }
}
