<?php

namespace App\Entities\CompanySeries\CompanyOperationType;

use App\Entities\CompanySeries\CompanyOperationType\Traits\CompanyOperationTypeRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $operation_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType whereOperationTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyOperationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyOperationType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CompanyOperationTypeRelationship;

    protected $table = 'company_operation_type';

    public const FILLABLE_FIELDS = [
        'company_id',
        'operation_type_id'
    ];
}
