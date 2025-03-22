<?php

namespace Database\Seeders\DefaultData;

use App\Entities\DefaultRate\DefaultRate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DefaultRate::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $rates = config('jobify_data.default_data.rates');

        $rates = addTimestamps($rates);

        DefaultRate::insert($rates);
    }
}
