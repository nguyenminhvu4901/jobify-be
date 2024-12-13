<?php

namespace App\Entities\JobLocation;

use App\Entities\JobLocation\Traits\JobLocationRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobLocation extends Model implements Transformable
{
    use TransformableTrait, HasFactory, JobLocationRelationship;

    protected $table = 'job_locations';

    protected $fillable = [
        'job_listing_id',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
}
