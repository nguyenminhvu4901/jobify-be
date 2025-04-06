<?php

namespace App\Entities\ProfileSeries\UserEducation;

use App\Entities\ProfileSeries\UserEducation\Traits\UserEducationRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserEducation extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserEducationRelationship;

    protected $table = 'user_educations';

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
