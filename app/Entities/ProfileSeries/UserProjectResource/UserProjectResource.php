<?php

namespace App\Entities\ProfileSeries\UserProjectResource;

use App\Entities\ProfileSeries\UserProjectResource\Traits\UserProjectResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProjectResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProjectResourceRelationship;

    protected $table = 'user_project_resources';

    public const FILLABLE_FIELDS = [
        'user_project_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
