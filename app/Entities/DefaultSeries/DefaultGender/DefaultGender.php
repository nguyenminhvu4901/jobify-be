<?php

namespace App\Entities\DefaultSeries\DefaultGender;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 
 *
 * @property int $id
 * @property string $gender 1: male, 2:female, 3:other
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultGender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultGender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultGender query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultGender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultGender whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultGender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DefaultGender whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DefaultGender extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = "default_genders";

    public const FILLABLE_FIELDS = [
        'gender'
    ];
}
