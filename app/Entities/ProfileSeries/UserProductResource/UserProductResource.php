<?php

namespace App\Entities\ProfileSeries\UserProductResource;

use App\Entities\ProfileSeries\UserProductResource\Traits\UserProductResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProductResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProductResourceRelationship;

    protected $table = 'user_product_resources';

    public const FILLABLE_FIELDS = [
        'user_product_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
