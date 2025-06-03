<?php

namespace App\Entities\ProfileSeries\UserEducation;

use App\Entities\ProfileSeries\UserEducation\Traits\UserEducationTrait;
use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserEducation extends BaseModel implements Transformable
{
    use UserEducationTrait;

    protected $table = UserEducationEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'major',
        'is_studying',
        'start_date',
        'end_date',
        'description'
    ];
}
