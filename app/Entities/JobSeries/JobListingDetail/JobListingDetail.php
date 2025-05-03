<?php

namespace App\Entities\JobSeries\JobListingDetail;

use App\Entities\JobSeries\JobListingDetail\Traits\JobListingDetailScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int $job_listing_id
 * @property string|null $description Nội dung tuyển dụng
 * @property string|null $requirement Yêu cầu ứng viên
 * @property string|null $income Thu nhập
 * @property string|null $benefit Quyền lợi
 * @property string|null $working_hour Thời gian làm việc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereByJobListingId(?int $jobListingId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereJobListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereRequirement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobListingDetail whereWorkingHour($value)
 * @mixin \Eloquent
 */
class JobListingDetail extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobListingDetailScope;

    protected $table = 'job_listing_details';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'description',
        'requirement',
        'income',
        'benefit',
        'working_hour'
    ];
}
