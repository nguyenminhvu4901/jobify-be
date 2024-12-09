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
        DB::table('default_genders')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $genders = config('jobify_data.default_data.genders');

        foreach ($genders as $gender)
        {
            DefaultGender::create($gender);
        }
    }
}
