<?php

namespace App\Entities\ProfileSeries\UserCertification;

use App\Entities\ProfileSeries\UserCertification\Traits\UserCertificationRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCertification extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserCertificationRelationship;

    protected $table = 'user_certifications';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'is_no_expiration',
        'start_date',
        'end_date'
    ];
}
