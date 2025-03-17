<?php

namespace Database\Seeders\CompanyWorkingDays;

use App\Entities\CompanyWorkingDay\CompanyWorkingDay;
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
        DB::table('company_working_days')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $companyWorkingDays = config('jobify_data.company_working_days.company_working_days');

        foreach ($companyWorkingDays as $companyWorkingDay)
        {
            CompanyWorkingDay::create($companyWorkingDay);
        }
    }
}
