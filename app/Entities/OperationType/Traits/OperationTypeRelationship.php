<?php

namespace App\Entities\OperationType\Traits;

use App\Entities\Company\Company;
use App\Entities\CompanyOperationType\CompanyOperationType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait OperationTypeRelationship
{
    /**
     * @return BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, CompanyOperationType::class,
            'operation_type_id', 'company_id',
            'id', 'id'
        );
    }
}
