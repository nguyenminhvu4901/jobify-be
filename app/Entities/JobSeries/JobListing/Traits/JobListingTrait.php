<?php

namespace App\Entities\JobSeries\JobListing\Traits;

use App\Traits\Scope\BaseScopeTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Prettus\Repository\Traits\TransformableTrait;

trait JobListingTrait
{
    use TransformableTrait,
        HasFactory,
        Sluggable,
        JobListingRelationship,
        Searchable,
        SoftDeletes,
        JobListingScope,
        BaseScopeTrait,
        SoftDeletes;
}
