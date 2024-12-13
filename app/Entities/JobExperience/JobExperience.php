<?php

namespace App\Entities\JobExperience;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobExperience extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_experiences';

    protected $fillable = ['name'];
}
