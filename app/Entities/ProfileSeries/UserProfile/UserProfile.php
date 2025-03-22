<?php

namespace App\Entities\ProfileSeries\UserProfile;

use App\Entities\ProfileSeries\UserProfile\Traits\UserProfileRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProfile extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserProfileRelationship;

    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',
        'position',
        'gender_id',
        'birth_date',
        'description'
    ];
}
