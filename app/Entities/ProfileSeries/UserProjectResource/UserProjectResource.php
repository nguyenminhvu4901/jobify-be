<?php

namespace App\Entities\ProfileSeries\UserProjectResource;

use App\Entities\ProfileSeries\UserProjectResource\Traits\UserProjectResourceTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserProjectResource extends BaseModel implements Transformable
{
    use UserProjectResourceTrait;

    protected $table = 'user_project_resources';

    public const FILLABLE_FIELDS = [
        'user_project_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
