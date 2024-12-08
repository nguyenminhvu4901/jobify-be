<?php

namespace App\Entities\DefaultStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DefaultStatus extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * @var string
     */
    protected $table = 'default_statuses';

    /**
     * @var string[]
     */
    protected $fillable = ['status'];

}
