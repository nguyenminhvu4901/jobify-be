<?php

namespace App\Entities\ProfileSeries\UserCertificationResource;

use App\Entities\ProfileSeries\UserCertificationResource\Traits\UserCertificationResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_certification_id
 * @property string $title Tiêu đề
 * @property string $path
 * @property string|null $description
 * @property int|null $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultContentType\DefaultContentType|null $contentType
 * @property-read \App\Entities\ProfileSeries\UserCertification\UserCertification|null $userCertification
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCertificationResource whereUserCertificationId($value)
 *
 * @mixin \Eloquent
 */
class UserCertificationResource extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserCertificationResourceRelationship;

    protected $table = 'user_certification_resources';

    public const FILLABLE_FIELDS = [
        'user_certification_id',
        'title',
        'path',
        'description',
        'content_type_id',
    ];
}
