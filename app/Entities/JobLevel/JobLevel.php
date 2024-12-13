<?php

namespace App\Entities\JobLevel;

use App\Entities\JobLevel\Traits\JobLevelRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobLevel extends Model implements Transformable
{
    use TransformableTrait, HasFactory, JobLevelRelationship;

    protected $table = 'job_levels';

    protected $fillable = ['title', 'description'];
}
