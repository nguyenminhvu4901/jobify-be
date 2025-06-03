<?php

namespace App\Entities\JobSeries\Currency\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait CurrencyTrait
{
    use TransformableTrait, HasFactory, CurrencyRelationship, CurrencyAttribute;
}
