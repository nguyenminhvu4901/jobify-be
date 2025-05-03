<?php

namespace App\Repositories\JobSeries\Position;

use App\Entities\JobSeries\Position\Position;
use App\Enums\Paginate\PaginateEnum;
use App\Repositories\BaseRepository;

class PositionRepositoryEloquent extends BaseRepository implements PositionRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Position::class;
    }

    /**
     * @param int|null $limit
     * @return mixed
     */
    public function getListPositionPaginate(?int $limit): mixed
    {
        $roots = $this->model->withDepthRootOrdered()
            ->cursorPaginate($limit ?? PaginateEnum::CURSOR_PAGINATE_POSITION->value);

        $roots->getCollection()->transform(function ($root) {
            $root->setRelation('children', $root->descendants()->withDepthOrderedToTree());
            return $root;
        });

        return $roots;
    }

    /**
     * @param array|string[] $columns $
     * @return mixed
     */
    public function getListLeafPosition(array $columns = ['*']): mixed
    {
        return $this->model->select($columns)->leafNodes();
    }

    /**
     * @param int|null $excludeId
     * @param array|string[] $columns $
     * @return mixed
     */
    public function getListLeafPositionExcludeMainPositionId(
        int $excludeId = null, array $columns = ['*']
    ): mixed
    {
        return $this->model->select($columns)->leafNodesExcludeId($excludeId);
    }
}
