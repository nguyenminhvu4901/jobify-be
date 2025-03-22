<?php

namespace Database\Seeders\DefaultData;

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

        $statuses = config('jobify_data.default_data.statuses');
        $statuses = addTimestamps($statuses);

        DefaultStatus::upsert($statuses, ['id'], ['name', 'description']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
