<?php

namespace App\Entities\ProfileSeries\UserSkill;

use App\Entities\ProfileSeries\UserSkill\Traits\UserSkillRelationship;
use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên kỹ năng
 * @property int|null $rate_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\DefaultSeries\DefaultRate\DefaultRate|null $rate
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill whereRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSkill whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserSkill extends BaseModel implements Transformable
{
    use HasFactory;
    use TransformableTrait;
    use UserSkillRelationship;

    protected $table = UserSkillEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'rate_id',
        'description',
    ];
}
