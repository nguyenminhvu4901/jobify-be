<?php

namespace App\Entities\Role;

use App\Entities\Role\Traits\RoleTrait;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use RoleTrait;

    protected $table = 'roles';

    public $timestamps = true;

    public const FILLABLE_FIELDS = [
        'name',
        'display_name',
        'guard_name',
    ];

    /**
     * @var string[]
     */
    protected $fillable = self::FILLABLE_FIELDS;
}
