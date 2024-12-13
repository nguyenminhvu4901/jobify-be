<?php

namespace App\Entities\UserCertificationResource;

use App\Entities\UserCertificationResource\Traits\UserCertificationResourceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCertificationResource extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserCertificationResourceRelationship;

    protected $table = 'user_certification_resources';

    protected $fillable = [
        'user_certification_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
