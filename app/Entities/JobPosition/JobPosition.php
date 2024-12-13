<?php

namespace App\Entities\JobPosition;

use App\Entities\JobPosition\Traits\JobPositionRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobPosition extends Model implements Transformable
{
    use TransformableTrait, HasFactory, JobPositionRelationship;

    protected $table = 'job_position';

    protected $fillable = [
        'job_listing_id',
        'position_id'
    ];
}
