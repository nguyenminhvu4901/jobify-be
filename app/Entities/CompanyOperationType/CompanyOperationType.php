<?php

namespace App\Entities\CompanyOperationType;

use App\Entities\CompanyOperationType\Traits\CompanyOperationTypeRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyOperationType extends Model implements Transformable
{
    use TransformableTrait, HasFactory, CompanyOperationTypeRelationship;

    protected $table = 'company_operation_type';

    protected $fillable = [
        'company_id',
        'operation_type_id'
    ];
}
