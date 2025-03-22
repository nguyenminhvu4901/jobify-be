<?php

namespace App\Entities\JobSeries\JobType;

use App\Entities\JobSeries\JobType\Traits\JobTypeRelationShip;
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
