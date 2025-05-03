<?php

namespace App\Entities\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\Traits\JobContactRelationship;
use App\Entities\JobSeries\JobContact\Traits\JobContactScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $job_listing_id
 * @property string $full_name
 * @property string $email
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact whereByJobListingId(?int $jobListingId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact whereJobListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobContact whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobContact extends BaseModel implements Transformable
{
    use HasFactory;
    use JobContactRelationship;
    use JobContactScope;
    use TransformableTrait;

    protected $table = 'job_contacts';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'full_name',
        'email',
        'phone_number',
    ];
}
