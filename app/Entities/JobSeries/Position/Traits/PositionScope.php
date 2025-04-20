<?php

namespace App\Entities\JobSeries\Position\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PositionScope
{
    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeWithDepthOrdered(Builder $query): mixed
    {
        return $query->withDepth()->defaultOrder();
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeWithDepthRootOrdered(Builder $query): mixed
    {
        return $query->withDepth()->whereIsRoot()->defaultOrder();
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeWithDepthOrderedToTree(Builder $query): mixed
    {
        return $query->withDepth()->defaultOrder()->get()->toTree();
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeLeafNodes(Builder $query): mixed
    {
        return $query->leaves();
    }

    /**
     * @param Builder $query
     * @param int $nodeId
     * @return mixed
     */
    public function scopeAncestors(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);
        return $node ? $node->ancestors()->get() : null;
    }

    /**
     * @param Builder $query
     * @param int $nodeId
     * @return mixed
     */
    public function scopeDescendants(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);
        return $node ? $node->descendants()->get() : null;
    }

    /**
     * @param Builder $query
     * @param int $nodeId
     * @return mixed
     */
    public function scopeChildren(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);
        return $node ? $node->children()->get() : null;
    }

    /**
     * @param Builder $query
     * @param int $nodeId
     * @return mixed
     */
    public function scopeSiblings(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);
        return $node ? $node->siblings()->get() : null;
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeRootNode(Builder $query): mixed
    {
        return $query->whereIsRoot();
    }

    /**
     * @param Builder $query
     * @param int $nodeId
     * @return mixed
     */
    public function scopeIsLeaf(Builder $query, int $nodeId): mixed
    {
        $node = $query->find($nodeId);
        return $node ? $node->isLeaf() : false;
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeWithDescendantsAndSelfIds(Builder $query, int $id): Builder
    {
        return $query->descendantsAndSelf($id)->select('id');
    }
}
