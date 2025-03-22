<?php

namespace Database\Seeders\OperationTypes;

use App\Entities\OperationType\OperationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $operationTypes = config('jobify_data.operation_types.operation_types');
        $operationTypes = addTimestamps($operationTypes);

        OperationType::upsert($operationTypes, ['id'], ['name', 'description']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
