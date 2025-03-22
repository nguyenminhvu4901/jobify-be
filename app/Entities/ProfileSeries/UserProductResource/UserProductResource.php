<?php

namespace App\Entities\ProfileSeries\UserProductResource;

use App\Entities\ProfileSeries\UserProductResource\Traits\UserProductResourceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserProductResource extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserProductResourceRelationship;

    protected $table = 'user_product_resources';

    protected $fillable = [
        'user_product_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
