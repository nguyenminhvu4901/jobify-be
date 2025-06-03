<?php

namespace App\Entities\ProfileSeries\UserProductResource;

use App\Entities\ProfileSeries\UserProductResource\Traits\UserProductResourceTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserProductResource extends BaseModel implements Transformable
{
    use UserProductResourceTrait;

    protected $table = 'user_product_resources';

    public const FILLABLE_FIELDS = [
        'user_product_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
