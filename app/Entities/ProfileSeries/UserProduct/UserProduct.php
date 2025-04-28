<?php

namespace App\Entities\ProfileSeries\UserProduct;

use App\Entities\ProfileSeries\UserProduct\Traits\UserProductRelationship;
use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name Tên sản phẩm
 * @property string $category Thể loại
 * @property string $finished_date Thời gian hoàn thành
 * @property string|null $description Mô tả chi tiết
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\ProfileSeries\UserProductResource\UserProductResource> $userProductResources
 * @property-read int|null $user_product_resources_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereFinishedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProduct whereUserId($value)
 * @mixin \Eloquent
 */
class UserProduct extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserProductRelationship;

    protected $table = UserProductEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'category',
        'finished_date',
        'description'
    ];
}
