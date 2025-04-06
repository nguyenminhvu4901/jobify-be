<?php

namespace App\Entities\ProfileSeries\UserProduct;

use App\Entities\ProfileSeries\UserProduct\Traits\UserProductRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProduct extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProductRelationship;

    protected $table = 'user_products';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'category',
        'finished_date',
        'description'
    ];
}
