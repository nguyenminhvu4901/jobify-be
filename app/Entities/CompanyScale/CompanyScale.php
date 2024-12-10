<?php

namespace App\Entities\CompanyScale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyScale extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = "company_scales";

    protected $fillable = ['name', 'description'];
}
