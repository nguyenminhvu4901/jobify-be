<?php

namespace App\Entities\ProfileSeries\UserCertificationResource;

use App\Entities\ProfileSeries\UserCertificationResource\Traits\UserCertificationResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCertificationResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserCertificationResourceRelationship;

    protected $table = 'user_certification_resources';

    public const FILLABLE_FIELDS = [
        'user_certification_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
