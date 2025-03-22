<?php

namespace Database\Seeders\DefaultData;

use App\Entities\DefaultGender\DefaultGender;
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
        DefaultGender::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $genders = config('jobify_data.default_data.genders');

        $genders = addTimestamps($genders);

        DefaultGender::insert($genders);
    }
}
