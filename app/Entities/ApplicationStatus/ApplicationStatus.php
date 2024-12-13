<?php

namespace App\Entities\ApplicationStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ApplicationStatus extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'application_statuses';

    protected $fillable = ['name', 'description'];
}
