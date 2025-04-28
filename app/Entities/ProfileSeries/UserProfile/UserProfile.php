<?php

namespace App\Entities\ProfileSeries\UserProfile;

use App\Entities\ProfileSeries\UserProfile\Traits\UserProfileRelationship;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $position Chức vụ
 * @property int|null $gender_id
 * @property string $birth_date
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultGender\DefaultGender|null $gender
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUserId($value)
 * @mixin \Eloquent
 */
class UserProfile extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProfileRelationship;

    protected $table = UserProfileEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'position',
        'gender_id',
        'birth_date',
        'description'
    ];
}
