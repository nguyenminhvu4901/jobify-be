<?php

namespace App\Entities\ProfileSeries\UserCertificationResource;

use App\Entities\ProfileSeries\UserCertificationResource\Traits\UserCertificationResourceTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserCertificationResource extends BaseModel implements Transformable
{
    use UserCertificationResourceTrait;

    protected $table = 'user_certification_resources';

    public const FILLABLE_FIELDS = [
        'user_certification_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
