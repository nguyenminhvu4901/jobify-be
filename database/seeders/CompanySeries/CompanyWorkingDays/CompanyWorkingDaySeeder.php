<?php

namespace Database\Seeders\CompanySeries\CompanyWorkingDays;

use App\Entities\CompanySeries\CompanyWorkingDay\CompanyWorkingDay;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyWorkingDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $companyWorkingDays = config('jobify_data.company_series.company_working_days.company_working_days');
        $companyWorkingDays = addTimestamps($companyWorkingDays);

        CompanyWorkingDay::upsert($companyWorkingDays, ['id'], ['working_day']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
