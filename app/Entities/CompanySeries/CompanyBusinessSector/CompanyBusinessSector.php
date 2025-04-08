<?php

namespace App\Entities\CompanySeries\CompanyBusinessSector;

use App\Entities\CompanySeries\CompanyBusinessSector\Traits\CompanyBusinessSectorRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyBusinessSector extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, CompanyBusinessSectorRelationship;

    protected $table = 'company_business_sector';

    public const FILLABLE_FIELDS = [
        'company_id',
        'business_sector_id'
    ];
}
