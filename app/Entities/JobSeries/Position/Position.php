<?php

namespace App\Entities\JobSeries\Position;

use App\Entities\JobSeries\Position\Traits\PositionRelationship;
use App\Entities\JobSeries\Position\Traits\PositionScope;
use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Position extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, NodeTrait, PositionRelationship, PositionScope;

    /**
     * @var string
     */
    protected $table = PositionEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
        '_lft',
        '_rgt',
        'parent_id'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/positions.name', $value)
        );
    }
}
