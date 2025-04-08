<?php

namespace App\Entities\JobApplicationSeries\ApplicationStatus;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ApplicationStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'application_statuses';

    public const FILLABLE_FIELDS = [
        'name', 'description'
    ];
}
