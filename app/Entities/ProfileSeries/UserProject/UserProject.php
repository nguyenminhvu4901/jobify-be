<?php

namespace App\Entities\ProfileSeries\UserProject;

use App\Entities\ProfileSeries\UserProject\Traits\UserProjectRelationship;
use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProject extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProjectRelationship;

    protected $table = UserProjectEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'client',
        'member',
        'position',
        'mission',
        'technology',
        'is_working',
        'start_date',
        'end_date',
        'description'
    ];
}
