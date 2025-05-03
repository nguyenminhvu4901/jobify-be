<?php

namespace App\Entities\JobSeries\JobSalary;

use App\Entities\JobSeries\JobSalary\Traits\JobSalaryRelationship;
use App\Entities\JobSeries\JobSalary\Traits\JobSalaryScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $job_listing_id
 * @property int|null $currency_id
 * @property int|null $job_salary_type_id
 * @property string|null $from
 * @property string|null $to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\JobSeries\Currency\Currency|null $currency
 * @property-read \App\Entities\JobSeries\JobListing\JobListing|null $jobListing
 * @property-read \App\Entities\JobSeries\JobSalaryType\JobSalaryType|null $jobSalaryType
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereByJobListingId(?int $jobListingId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereJobListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereJobSalaryTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSalary whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobSalary extends BaseModel implements Transformable
{
    use HasFactory;
    use JobSalaryRelationship;
    use JobSalaryScope;
    use TransformableTrait;

    protected $table = 'job_salaries';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'currency_id',
        'job_salary_type_id',
        'from',
        'to',
    ];
}
