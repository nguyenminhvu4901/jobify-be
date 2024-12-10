<?php

namespace App\Entities\Province;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Province extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'provinces';

    protected $fillable = [
        'code',
        'province_name'
    ];
}
