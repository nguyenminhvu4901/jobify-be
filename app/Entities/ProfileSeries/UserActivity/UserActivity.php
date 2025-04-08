<?php

namespace App\Entities\ProfileSeries\UserActivity;

use App\Entities\ProfileSeries\UserActivity\Traits\UserActivityRelationship;
use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserActivity extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserActivityRelationship;

    protected $table = UserActivityEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'position',
        'start_date',
        'end_date',
        'description'
    ];
}
