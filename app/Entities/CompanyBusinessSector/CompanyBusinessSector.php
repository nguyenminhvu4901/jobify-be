<?php

namespace App\Entities\CompanyBusinessSector;

use App\Entities\CompanyBusinessSector\Traits\CompanyBusinessSectorRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyBusinessSector extends Model implements Transformable
{
    use TransformableTrait, HasFactory, CompanyBusinessSectorRelationship;

    protected $table = 'company_business_sector';

    protected $fillable = [
        'company_id',
        'business_sector_id'
    ];
}
