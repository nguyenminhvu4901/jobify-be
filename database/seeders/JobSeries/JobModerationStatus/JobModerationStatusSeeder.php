<?php

namespace Database\Seeders\JobSeries\JobModerationStatus;

use App\Entities\JobSeries\JobModerationStatus\JobModerationStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobModerationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobTypes = config('jobify_data.job_series.job_moderation_statuses.job_moderation_statuses');
        $jobTypes = addTimestamps($jobTypes);

        JobModerationStatus::upsert($jobTypes, ['id'], ['name']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
