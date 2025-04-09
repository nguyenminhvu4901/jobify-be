<?php

namespace Database\Seeders\JobSeries\JobSalaryType;

use App\Entities\JobSeries\JobSalaryType\JobSalaryType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSalaryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $jobSalaryTypes = config('jobify_data.job_series.job_salary_types.job_salary_types');
        $jobSalaryTypes = addTimestamps($jobSalaryTypes);

        JobSalaryType::upsert($jobSalaryTypes, ['id'], ['type']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
