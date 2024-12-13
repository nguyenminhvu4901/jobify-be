<?php

namespace App\Entities\UserProjectResource;

use App\Entities\UserProjectResource\Traits\UserProjectResourceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProjectResource extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserProjectResourceRelationship;

    protected $table = 'user_project_resources';

    protected $fillable = [
        'user_project_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
