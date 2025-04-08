<?php

namespace Database\Seeders\JobSeries\JobAgeRanges;

use App\Entities\JobSeries\JobAgeRange\JobAgeRange;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobAgeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobAgeRanges = config('jobify_data.job_series.job_age_ranges.job_age_ranges');
        $jobAgeRanges = addTimestamps($jobAgeRanges);

        JobAgeRange::upsert($jobAgeRanges, ['id'], ['min_age', 'max_age']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
