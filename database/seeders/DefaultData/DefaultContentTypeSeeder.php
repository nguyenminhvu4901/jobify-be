<?php

namespace Database\Seeders\DefaultData;

use App\Entities\DefaultSeries\DefaultContentType\DefaultContentType;
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

        $contentTypes = config('jobify_data.default_data.content_types');
        $contentTypes = addTimestamps($contentTypes);

        DefaultContentType::upsert($contentTypes, ['id'], ['content_type']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
