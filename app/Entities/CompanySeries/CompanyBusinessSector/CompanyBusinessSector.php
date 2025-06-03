<?php

namespace App\Entities\CompanySeries\CompanyBusinessSector;

use App\Entities\CompanySeries\CompanyBusinessSector\Traits\CompanyBusinessSectorTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class CompanyBusinessSector extends BaseModel implements Transformable
{
    use CompanyBusinessSectorTrait;

    protected $table = 'company_business_sector';

    public const FILLABLE_FIELDS = [
        'company_id',
        'business_sector_id'
    ];
}
