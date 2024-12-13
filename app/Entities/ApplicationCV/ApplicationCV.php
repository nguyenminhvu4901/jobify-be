<?php

namespace App\Entities\ApplicationCV;

use App\Entities\ApplicationCV\Traits\ApplicationCVRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ApplicationCV extends Model implements Transformable
{
    use TransformableTrait, HasFactory, ApplicationCVRelationship;

    protected $table = 'application_cv';

    protected $fillable = ['title', 'path', 'job_application_id'];
}
