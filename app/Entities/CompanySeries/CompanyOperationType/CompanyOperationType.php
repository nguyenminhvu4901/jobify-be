<?php

namespace App\Entities\CompanySeries\CompanyOperationType;

use App\Entities\CompanySeries\CompanyOperationType\Traits\CompanyOperationTypeRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyOperationType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CompanyOperationTypeRelationship;

    protected $table = 'company_operation_type';

    public const FILLABLE_FIELDS = [
        'company_id',
        'operation_type_id'
    ];
}
