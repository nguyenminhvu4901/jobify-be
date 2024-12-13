<?php

namespace App\Entities\JobType;

use App\Entities\JobType\Traits\JobTypeRelationShip;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobType extends Model implements Transformable
{
    use TransformableTrait, HasFactory, JobTypeRelationShip;

    protected $table = 'job_types';

    protected $fillable = [
        'type'
    ];
}
