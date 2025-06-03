<?php

namespace App\Entities\DefaultSeries\DefaultStatus\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait DefaultStatusTrait
{
    use TransformableTrait, HasFactory, DefaultStatusAttribute;
}
