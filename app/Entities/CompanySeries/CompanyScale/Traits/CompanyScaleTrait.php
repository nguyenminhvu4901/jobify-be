<?php

namespace App\Entities\CompanySeries\CompanyScale\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait CompanyScaleTrait
{
    use TransformableTrait, HasFactory, CompanyScaleRelationship, CompanyScaleAttribute;
}
