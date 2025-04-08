<?php

namespace Database\Seeders;

use Database\Seeders\CompanySeries\BusinessSectors\BusinessSectorSeeder;
use Database\Seeders\CompanySeries\CompanyScales\CompanyScaleSeeder;
use Database\Seeders\CompanySeries\CompanyWorkingDays\CompanyWorkingDaySeeder;
use Database\Seeders\CompanySeries\OperationTypes\OperationTypeSeeder;
use Database\Seeders\DefaultData\DefaultContentTypeSeeder;
use Database\Seeders\DefaultData\DefaultGenderSeeder;
use Database\Seeders\DefaultData\DefaultRateSeeder;
use Database\Seeders\DefaultData\DefaultStatusSeeder;
use Database\Seeders\JobSeries\JobAgeRanges\JobAgeRangeSeeder;
use Database\Seeders\JobSeries\JobEducationLevels\JobEducationLevelSeeder;
use Database\Seeders\JobSeries\JobExperiences\JobExperienceSeeder;
use Database\Seeders\JobSeries\JobLevels\JobLevelSeeder;
use Database\Seeders\JobSeries\JobTypes\JobTypeSeeder;
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

            JobTypeSeeder::class,
            JobLevelSeeder::class,
            JobExperienceSeeder::class,
            JobEducationLevelSeeder::class,
            JobAgeRangeSeeder::class,

            RoleSeeder::class,
            UserSeeder::class
        ]);
    }
}
