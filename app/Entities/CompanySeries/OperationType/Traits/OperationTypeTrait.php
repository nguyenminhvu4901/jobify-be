<?php

namespace App\Entities\CompanySeries\OperationType\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait OperationTypeTrait
{
    use TransformableTrait, HasFactory, OperationTypeRelationship, OperationTypeAttribute;
}
