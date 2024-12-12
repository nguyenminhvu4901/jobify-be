<?php

namespace App\Entities\OperationType;

use App\Entities\OperationType\Traits\OperationTypeRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OperationType extends Model implements Transformable
{
    use TransformableTrait, HasFactory, OperationTypeRelationship;

    protected $table = 'operation_types';

    protected $fillable = [
        'name',
        'description'
    ];
}
