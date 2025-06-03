<?php

namespace App\Entities\ProfileSeries\UserPrizeResource\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserPrizeResourceTrait
{
    use TransformableTrait, HasFactory, UserPrizeResourceRelationship;
}
