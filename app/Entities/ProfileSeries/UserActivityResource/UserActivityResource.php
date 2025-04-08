<?php

namespace App\Entities\ProfileSeries\UserActivityResource;

use App\Entities\ProfileSeries\UserActivityResource\Traits\UserActivityResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserActivityResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserActivityResourceRelationship;

    protected $table = 'user_activity_resources';

    public const FILLABLE_FIELDS = [
        'user_activity_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
