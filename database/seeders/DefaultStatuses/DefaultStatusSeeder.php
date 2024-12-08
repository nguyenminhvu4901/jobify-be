<?php

namespace Database\Seeders\DefaultStatuses;

use App\Entities\DefaultStatus\DefaultStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('default_statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $statuses = config('constants.default_statuses');

        foreach ($statuses as $status)
        {
            DefaultStatus::create($status);
        }
    }
}
