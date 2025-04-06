<?php

namespace App\Entities\DefaultSeries\DefaultStatus;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * @var string
     */
    protected $table = 'default_statuses';

    public const FILLABLE_FIELDS = [
        'status'
    ];
}
