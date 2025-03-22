<?php

namespace Database\Seeders\DefaultData;

use App\Entities\DefaultSeries\DefaultGender\DefaultGender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $genders = config('jobify_data.default_data.genders');
        $genders = addTimestamps($genders);

        DefaultGender::upsert($genders, ['id'], ['name', 'description']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
