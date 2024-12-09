<?php

namespace App\Entities\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    protected $table = 'roles';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'display_name',
        'guard_name',
    ];
}
