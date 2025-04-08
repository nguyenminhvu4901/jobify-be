<?php

namespace Database\Seeders\JobSeries\JobLevels;

use App\Entities\JobSeries\JobLevel\JobLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobLevels = config('jobify_data.job_series.job_levels.job_levels');
        $jobLevels = addTimestamps($jobLevels);

        JobLevel::upsert($jobLevels, ['id'], ['title', 'description']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
