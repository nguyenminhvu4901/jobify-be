<?php

namespace App\Entities\ProfileSeries\UserCertification;

use App\Entities\ProfileSeries\UserCertification\Traits\UserCertificationTrait;
use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserCertification extends BaseModel implements Transformable
{
    use UserCertificationTrait;

    protected $table = UserCertificationEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'is_no_expiration',
        'start_date',
        'end_date'
    ];
}
