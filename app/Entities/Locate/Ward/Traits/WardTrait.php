<?php

namespace App\Entities\Locate\Ward\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait WardTrait
{
    use TransformableTrait, HasFactory, WardRelationship, WardScope;
}
