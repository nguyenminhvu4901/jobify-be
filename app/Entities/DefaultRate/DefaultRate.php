<?php

namespace App\Entities\DefaultRate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultRate extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'default_rates';

    protected $fillable = ['rate'];
}
