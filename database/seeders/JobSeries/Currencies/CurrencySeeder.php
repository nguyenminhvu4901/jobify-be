<?php

namespace Database\Seeders\JobSeries\Currencies;

use App\Entities\JobSeries\Currency\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $currencies = config('jobify_data.job_series.currencies.currencies');
        $currencies = addTimestamps($currencies);

        Currency::upsert($currencies, ['id'], ['name']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
