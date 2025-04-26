<?php

namespace App\Entities\JobApplicationSeries\ApplicationStatus;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => translatable_or_original("data/job_application_series/application_statuses.name", $value)
        );
    }

    /**
     * @return Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => translatable_or_original("data/job_application_series/application_statuses.description", $value)
        );
    }
}
