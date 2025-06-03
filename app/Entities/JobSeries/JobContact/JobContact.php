<?php

namespace App\Entities\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\Traits\JobContactTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobContact extends BaseModel implements Transformable
{
    use JobContactTrait;

    protected $table = 'job_contacts';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'full_name',
        'email',
        'phone_number',
    ];
}
