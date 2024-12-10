<?php

namespace App\Entities\CompanyAddress;

use App\Entities\CompanyAddress\Traits\CompanyAddressRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyAddress extends Model implements Transformable
{
    use TransformableTrait, HasFactory, CompanyAddressRelationship;

    protected $table = "company_address";

    protected $fillable = [
        'company_id',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
}
