<?php

namespace Database\Seeders\JobSeries\JobTypes;

use App\Entities\JobSeries\JobType\JobType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobTypes = config('jobify_data.job_series.job_types.job_types');
        $jobTypes = addTimestamps($jobTypes);

        JobType::upsert($jobTypes, ['id'], ['type']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
