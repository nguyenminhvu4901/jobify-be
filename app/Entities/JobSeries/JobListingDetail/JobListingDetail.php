<?php

namespace App\Entities\JobSeries\JobListingDetail;

use App\Entities\JobSeries\JobListingDetail\Traits\JobListingDetailTrait;
use App\Models\BaseModel;
use Mews\Purifier\Casts\CleanHtml;
use Prettus\Repository\Contracts\Transformable;

class JobListingDetail extends BaseModel implements Transformable
{
    use JobListingDetailTrait;

    protected $table = 'job_listing_details';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'description',
        'requirement',
        'income',
        'benefit',
        'working_hour'
    ];

    protected $casts = [
        'description' => CleanHtml::class,
        'requirement' => CleanHtml::class,
        'income' => CleanHtml::class,
        'benefit' => CleanHtml::class,
        'working_hour' => CleanHtml::class
    ];
}
