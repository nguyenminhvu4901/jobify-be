<?php

namespace Database\Seeders\JobApplication\ApplicationStatus;

use App\Entities\JobApplicationSeries\ApplicationStatus\ApplicationStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $applicationStatuses = config('jobify_data.job_application_series.application_statuses.application_statuses');
        $applicationStatuses = addTimestamps($applicationStatuses);

        ApplicationStatus::upsert($applicationStatuses, ['id'], ['name', 'description']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
