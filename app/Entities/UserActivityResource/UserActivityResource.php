<?php

namespace App\Entities\UserActivityResource;

use App\Entities\UserActivityResource\Traits\UserActivityResourceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserActivityResource extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserActivityResourceRelationship;

    protected $table = 'user_activity_resources';

    protected $fillable = [
        'user_activity_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
