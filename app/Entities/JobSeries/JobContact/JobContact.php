<?php

namespace App\Entities\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\Traits\JobContactRelationship;
use App\Entities\JobSeries\JobContact\Traits\JobContactScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobContact extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobContactRelationship, JobContactScope;

    protected $table = 'job_contacts';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'full_name',
        'email',
        'phone_number',
    ];
}
