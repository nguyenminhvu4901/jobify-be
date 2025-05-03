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

/**
 * @property int $id
 * @property string $name
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection<int, Position> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Entities\JobSeries\JobListing\JobListing> $jobListings
 * @property-read int|null $job_listings_count
 * @property-read Position|null $parent
 *
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position ancestors(int $nodeId)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position children(int $nodeId)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position d()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position descendants(int $nodeId)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position isLeaf(int $nodeId)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position leafNodes()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position leafNodesExcludeId(?int $excludeId)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position query()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position rootNode()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position siblings(int $nodeId)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereNodeBetween($values, $boolean = 'and', $not = false, $query = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position withDepthOrdered()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position withDepthOrderedToTree()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position withDepthRootOrdered()
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position withDescendantsAndSelfIds(int $id)
 * @method static \Kalnoy\Nestedset\QueryBuilder<static>|Position withoutRoot()
 *
 * @mixin \Eloquent
 */
class Position extends BaseModel implements Transformable
{
    use HasFactory;
    use NodeTrait;
    use PositionRelationship;
    use PositionScope;
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = PositionEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name',
        '_lft',
        '_rgt',
        'parent_id',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => translatable_or_original('data/job_series/positions.name', $value)
        );
    }
}
