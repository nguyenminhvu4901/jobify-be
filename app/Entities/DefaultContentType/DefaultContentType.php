<?php

namespace App\Entities\DefaultContentType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultContentType extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'default_content_types';

    protected $fillable = ['content_type'];
}
