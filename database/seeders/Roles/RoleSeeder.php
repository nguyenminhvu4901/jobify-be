<?php

namespace Database\Seeders\Roles;

use App\Entities\Role\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $listRoles = config('jobify_data.roles.roles');
        foreach ($listRoles as $role)
        {
            Role::create($role);
        }

    }
}
