<?php

namespace Database\Seeders\CompanySeries\BusinessSectors;

use App\Entities\CompanySeries\BusinessSector\BusinessSector;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $businessSectors = config('jobify_data.company_series.business_sectors.business_sectors');
        $businessSectors = addTimestamps($businessSectors);

        BusinessSector::upsert($businessSectors, ['id'], ['name', 'description']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
