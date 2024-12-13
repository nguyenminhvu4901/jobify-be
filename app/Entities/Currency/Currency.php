<?php

namespace App\Entities\Currency;

use App\Entities\Currency\Traits\CurrencyRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Currency extends Model implements Transformable
{
    use TransformableTrait, HasFactory, CurrencyRelationship;

    protected $table = 'currencies';

    protected $fillable = ['name'];
}
