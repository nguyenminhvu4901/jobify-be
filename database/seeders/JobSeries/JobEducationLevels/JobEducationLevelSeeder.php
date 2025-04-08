<?php

namespace Database\Seeders\JobSeries\JobEducationLevels;

use App\Entities\JobSeries\JobEducationLevel\JobEducationLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobEducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobEducations = config('jobify_data.job_series.job_education_levels.job_education_levels');
        $jobEducations = addTimestamps($jobEducations);

        JobEducationLevel::upsert($jobEducations, ['id'], ['name']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
