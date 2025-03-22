<?php

namespace App\Entities\ProfileSeries\UserCertification;

use App\Entities\ProfileSeries\UserCertification\Traits\UserCertificationRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCertification extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserCertificationRelationship;

    protected $table = 'user_certifications';

    protected $fillable = [
        'user_id',
        'name',
        'organization',
        'is_no_expiration',
        'start_date',
        'end_date'
    ];
}
