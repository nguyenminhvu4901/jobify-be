<?php

namespace App\Entities\ProfileSeries\UserLocation;

use App\Entities\ProfileSeries\UserLocation\Traits\UserLocationRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserLocation extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserLocationRelationship;

    protected $table = 'user_locations';

    protected $with = ['province', 'district', 'ward'];

    protected $fillable = [
        'user_id',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
}
