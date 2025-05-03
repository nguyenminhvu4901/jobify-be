<?php

namespace Database\Seeders\CompanySeries\CompanyScales;

use App\Entities\CompanySeries\CompanyScale\CompanyScale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $companyScales = config('jobify_data.company_series.company_scales.company_scales');
        $companyScales = addTimestamps($companyScales);

        CompanyScale::upsert($companyScales, ['id'], ['name', 'description']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
