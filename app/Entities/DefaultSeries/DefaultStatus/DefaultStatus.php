<?php

namespace App\Entities\DefaultSeries\DefaultStatus;

use App\Entities\DefaultSeries\DefaultStatus\Traits\DefaultStatusTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class DefaultStatus extends BaseModel implements Transformable
{
    use DefaultStatusTrait;

    /**
     * @var string
     */
    protected $table = 'default_statuses';

    public const FILLABLE_FIELDS = [
        'status'
    ];
}
