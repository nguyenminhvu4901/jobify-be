<?php

namespace App\Entities\ProfileSeries\UserActivity;

use App\Entities\ProfileSeries\UserActivity\Traits\UserActivityRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserActivity extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserActivityRelationship;

    protected $table = 'user_activities';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'position',
        'start_date',
        'end_date',
        'description'
    ];
}
