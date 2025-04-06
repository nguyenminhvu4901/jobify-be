<?php

namespace App\Entities\ProfileSeries\UserProfile;

use App\Entities\ProfileSeries\UserProfile\Traits\UserProfileRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProfile extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProfileRelationship;

    protected $table = 'user_profiles';

    public const FILLABLE_FIELDS = [
        'user_id',
        'position',
        'gender_id',
        'birth_date',
        'description'
    ];
}
