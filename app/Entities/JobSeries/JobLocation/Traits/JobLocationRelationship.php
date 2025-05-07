<?php

namespace App\Entities\JobSeries\JobLocation\Traits;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\Locate\District\District;
use App\Entities\Locate\Province\Province;
use App\Entities\Locate\Ward\Ward;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait JobLocationRelationship
{
    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id', 'id');
    }
}
