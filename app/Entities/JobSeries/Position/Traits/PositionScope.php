<?php

namespace App\Entities\JobSeries\Position\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PositionScope
{
    public function scopeWithDepthOrdered(Builder $query): mixed
    {
        return $query->withDepth()->defaultOrder();
    }

    public function scopeWithDepthRootOrdered(Builder $query): mixed
    {
        return $query->withDepth()->whereIsRoot()->defaultOrder();
    }

    public function scopeWithDepthOrderedToTree(Builder $query): mixed
    {
        return $query->withDepth()->defaultOrder()->get()->toTree();
    }

    public function scopeLeafNodes(Builder $query): mixed
    {
        return $query->leaves();
    }

    public function scopeLeafNodesExcludeId(Builder $query, ?int $excludeId): mixed
    {
        return $query
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->leaves();
    }

    public function scopeAncestors(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);

        return $node ? $node->ancestors()->get() : null;
    }

    public function scopeDescendants(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);

        return $node ? $node->descendants()->get() : null;
    }

    public function scopeChildren(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);

        return $node ? $node->children()->get() : null;
    }

    public function scopeSiblings(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);

        return $node ? $node->siblings()->get() : null;
    }

    public function scopeRootNode(Builder $query): mixed
    {
        return $query->whereIsRoot();
    }

    public function scopeIsLeaf(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);

        return $node ? $node->isLeaf() : false;
    }

    public function scopeWithDescendantsAndSelfIds(Builder $query, int $id): Builder
    {
        return $query->descendantsAndSelf($id)->select('id');
    }
}
