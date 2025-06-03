<?php

namespace App\Entities\DefaultSeries\DefaultContentType;

use App\Entities\DefaultSeries\DefaultContentType\Traits\DefaultContentTypeTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class DefaultContentType extends BaseModel implements Transformable
{
    use DefaultContentTypeTrait;

    protected $table = 'default_content_types';

    public const FILLABLE_FIELDS = [
        'content_type'
    ];
}
