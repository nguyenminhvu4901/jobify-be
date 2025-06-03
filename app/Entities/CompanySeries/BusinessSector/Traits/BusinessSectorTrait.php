<?php

namespace App\Entities\CompanySeries\BusinessSector\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait BusinessSectorTrait
{
    use TransformableTrait, HasFactory, BusinessSectorRelationship, BusinessSectorAttribute;
}
