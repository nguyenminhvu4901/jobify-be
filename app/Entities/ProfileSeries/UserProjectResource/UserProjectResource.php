<?php

namespace App\Entities\ProfileSeries\UserProjectResource;

use App\Entities\ProfileSeries\UserProjectResource\Traits\UserProjectResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_project_id
 * @property string $title Tiêu đề
 * @property string $path
 * @property string|null $description
 * @property int|null $content_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultContentType\DefaultContentType|null $contentType
 * @property-read \App\Entities\ProfileSeries\UserProject\UserProject|null $userProject
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource whereContentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProjectResource whereUserProjectId($value)
 * @mixin \Eloquent
 */
class UserProjectResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProjectResourceRelationship;

    protected $table = 'user_project_resources';

    public const FILLABLE_FIELDS = [
        'user_project_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
