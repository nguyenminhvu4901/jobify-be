<?php

namespace App\Entities\UserCertificationType;

use App\Entities\UserCertificationType\Traits\UserCertificationTypeRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCertificationType extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserCertificationTypeRelationship;

    protected $table = 'user_certification_types';

    protected $fillable = [
        'id', 'type'
    ];
}
