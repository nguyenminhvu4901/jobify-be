<?php

namespace App\Entities\DefaultGender;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultGender extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = "default_genders";

    protected $fillable = ['gender'];
}
