<?php

namespace Database\Seeders\DefaultData;

use App\Entities\DefaultContentType\DefaultContentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DefaultContentType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $contentTypes = config('jobify_data.default_data.content_types');

        $contentTypes = addTimestamps($contentTypes);

        DefaultContentType::insert($contentTypes);
    }
}
