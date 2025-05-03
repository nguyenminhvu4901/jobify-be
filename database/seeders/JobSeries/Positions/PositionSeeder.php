<?php

namespace Database\Seeders\JobSeries\Positions;

use App\Entities\JobSeries\Position\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Position::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->seedNestedPositions();
    }

    private function seedNestedPositions(?array $positions = null, ?Position $parent = null): void
    {
        $positions = $positions ?? config('jobify_data.job_series.positions');

        foreach ($positions as $data) {
            $children = $data['children'] ?? [];
            unset($data['children']);

            $node = new Position($data);

            if ($parent) {
                $parent->appendNode($node);
            } else {
                $node->save();
            }

            if (! empty($children)) {
                $this->seedNestedPositions($children, $node);
            }
        }
    }
}
