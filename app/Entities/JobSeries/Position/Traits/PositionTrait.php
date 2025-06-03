<?php

namespace App\Entities\JobSeries\Position\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use Prettus\Repository\Traits\TransformableTrait;

trait PositionTrait
{
    use TransformableTrait, HasFactory, NodeTrait, PositionRelationship, PositionScope, PositionAttribute;
}
