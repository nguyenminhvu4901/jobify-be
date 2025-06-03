<?php

namespace App\Entities\CompanySeries\CompanyWorkingDay\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait CompanyWorkingDayTrait
{
    use TransformableTrait, HasFactory, CompanyWorkingDayAttribute;
}
