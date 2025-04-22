<?php

namespace Database\Seeders\JobSeries\JobVisibilityStatus;

use App\Entities\JobSeries\JobVisibilityStatus\JobVisibilityStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobVisibilityStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobTypes = config('jobify_data.job_series.job_visibility_statuses.job_visibility_statuses');
        $jobTypes = addTimestamps($jobTypes);

        JobVisibilityStatus::upsert($jobTypes, ['id'], ['name']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
