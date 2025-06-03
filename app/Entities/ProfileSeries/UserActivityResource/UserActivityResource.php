<?php

namespace App\Entities\ProfileSeries\UserActivityResource;

use App\Entities\ProfileSeries\UserActivityResource\Traits\UserActivityResourceTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserActivityResource extends BaseModel implements Transformable
{
    use UserActivityResourceTrait;

    protected $table = 'user_activity_resources';

    public const FILLABLE_FIELDS = [
        'user_activity_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
