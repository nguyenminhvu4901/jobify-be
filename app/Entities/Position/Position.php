<?php

namespace App\Entities\Position;

use App\Entities\Position\Traits\PositionRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Position extends Model implements Transformable
{
    use TransformableTrait, HasFactory, NodeTrait, PositionRelationship;

    protected $table = 'positions';

    protected $fillable = [
        'name',
        '_lft',
        '_rgt',
        'parent_id'
    ];
}
