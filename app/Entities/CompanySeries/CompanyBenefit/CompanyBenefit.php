<?php

namespace App\Entities\CompanySeries\CompanyBenefit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyBenefit extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = "company_benefits";

    protected $fillable = [
        'company_id',
        'benefit_name',
        'description'
    ];
}
