<?php

namespace App\Entities\ProfileSeries\UserPrize\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserPrizeTrait
{
    use TransformableTrait, HasFactory, UserPrizeRelationship;
}
