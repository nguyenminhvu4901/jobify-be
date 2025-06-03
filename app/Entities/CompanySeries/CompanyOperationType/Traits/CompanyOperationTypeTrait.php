<?php

namespace App\Entities\CompanySeries\CompanyOperationType\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait CompanyOperationTypeTrait
{
    use TransformableTrait, HasFactory, CompanyOperationTypeRelationship;
}
