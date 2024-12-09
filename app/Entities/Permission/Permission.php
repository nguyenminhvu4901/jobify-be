<?php

namespace App\Entities\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    protected $table = 'permissions';

    public $timestamps = true;

    protected $fillable = ['name', 'display_name', 'parent_id'];
}
