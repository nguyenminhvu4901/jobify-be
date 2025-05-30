<?php

namespace App\Entities\JobApplicationSeries\JobApplication;

use App\Entities\JobApplicationSeries\JobApplication\Traits\JobApplicationRelationship;
use App\Entities\JobApplicationSeries\JobApplication\Traits\JobApplicationScope;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 *
 *
 * @property int $id
 * @property int|null $user_id Người ứng tuyển
 * @property int|null $job_listing_id Công việc
 * @property string $applied_at Ngày ứng tuyển
 * @property string|null $cover_letter Thư giới thiệu đến nhà tuyển dụng
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobApplicationSeries\ApplicationCV\ApplicationCV> $applicationCV
 * @property-read int|null $application_c_v_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobApplicationSeries\ApplicationStatus\ApplicationStatus> $applicationStatuses
 * @property-read int|null $application_statuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobApplicationSeries\JobApplicationStatus\JobApplicationStatus> $jobApplicationStatus
 * @property-read int|null $job_application_status_count
 * @property-read \App\Entities\JobSeries\JobListing\JobListing|null $jobListings
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereAppliedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereCoverLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereJobListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUserIdAndJobListingId(int $userId, int $jobListingId)
 * @property string $full_name
 * @property string $email
 * @property string $phone_number
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication wherePhoneNumber($value)
 * @mixin \Eloquent
 */
class JobApplication extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobApplicationRelationship, JobApplicationScope;

    protected $table = JobApplicationEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'job_listing_id',

        'full_name',
        'email',
        'phone_number',

        'applied_at',
        'cover_letter',

        'apply_number'
    ];
}
