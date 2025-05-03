<?php

namespace App\Entities\ProfileSeries\UserExperienceResource;

use App\Entities\ProfileSeries\UserExperienceResource\Traits\UserExperienceResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_experience_id
 * @property string $title Tiêu đề
 * @property string $path
 * @property string|null $description
 * @property int|null $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultContentType\DefaultContentType|null $contentType
 * @property-read \App\Entities\ProfileSeries\UserExperience\UserExperience|null $userExperience
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserExperienceResource whereUserExperienceId($value)
 *
 * @mixin \Eloquent
 */
class UserExperienceResource extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserExperienceResourceRelationship;

    protected $table = 'user_experience_resources';

    public const FILLABLE_FIELDS = [
        'user_experience_id',
        'title',
        'path',
        'description',
        'content_type_id',
    ];
}
