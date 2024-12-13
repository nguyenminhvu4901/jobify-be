<?php

namespace App\Entities\JobContact;

use App\Entities\JobContact\Traits\JobContactRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobContact extends Model implements Transformable
{
    use TransformableTrait, HasFactory, JobContactRelationship;

    protected $table = 'job_contacts';

    protected $fillable = [
        'job_listing_id',
        'full_name',
        'email',
        'phone_number',
    ];
}
