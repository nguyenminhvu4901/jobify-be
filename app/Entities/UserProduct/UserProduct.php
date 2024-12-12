<?php

namespace App\Entities\UserProduct;

use App\Entities\UserProduct\Traits\UserProductRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProduct extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserProductRelationship;

    protected $table = 'user_products';

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'finished_date',
        'description'
    ];
}
