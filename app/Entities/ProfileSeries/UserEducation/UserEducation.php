<?php

namespace App\Entities\ProfileSeries\UserEducation;

use App\Entities\ProfileSeries\UserEducation\Traits\UserEducationRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserEducation extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserEducationRelationship;

    protected $table = 'user_educations';

    protected $fillable = [
        'user_id',
        'name',
        'major',
        'is_studying',
        'start_date',
        'end_date',
        'description'
    ];
}
