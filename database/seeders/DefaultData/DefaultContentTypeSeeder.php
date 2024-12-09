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
        DB::table('default_content_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $contentTypes = config('jobify_data.default_data.content_types');

        foreach ($contentTypes as $contentType)
        {
            DefaultContentType::create($contentType);
        }
    }
}
