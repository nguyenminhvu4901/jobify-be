<?php

namespace Database\Seeders\CompanyScales;

use App\Entities\CompanyScale\CompanyScale;
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
        DB::table('company_scales')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $companyScales = config('jobify_data.company_scales.company_scales');

        foreach ($companyScales as $companyScale)
        {
            CompanyScale::create($companyScale);
        }

    }
}
