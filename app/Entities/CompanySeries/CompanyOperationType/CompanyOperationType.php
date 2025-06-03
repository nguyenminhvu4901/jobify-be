<?php

namespace App\Entities\CompanySeries\CompanyOperationType;

use App\Entities\CompanySeries\CompanyOperationType\Traits\CompanyOperationTypeTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class CompanyOperationType extends BaseModel implements Transformable
{
    use CompanyOperationTypeTrait;

    protected $table = 'company_operation_type';

    public const FILLABLE_FIELDS = [
        'company_id',
        'operation_type_id'
    ];
}
