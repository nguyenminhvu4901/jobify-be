<?php

namespace App\Entities\DefaultSeries\DefaultContentType;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultContentType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'default_content_types';

    public const FILLABLE_FIELDS = [
        'content_type'
    ];
}
