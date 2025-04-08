<?php

namespace Database\Seeders\JobSeries\JobExperiences;

use App\Entities\JobSeries\JobExperience\JobExperience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobExperiences = config('jobify_data.job_series.job_experiences.job_experiences');
        $jobExperiences = addTimestamps($jobExperiences);

        JobExperience::upsert($jobExperiences, ['id'], ['name']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
