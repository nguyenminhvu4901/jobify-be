<?php

namespace App\Entities\CompanySeries\CompanyBusinessSector\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait CompanyBusinessSectorTrait
{
    use TransformableTrait, HasFactory, CompanyBusinessSectorRelationship;
}
