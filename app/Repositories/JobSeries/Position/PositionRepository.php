<?php

namespace App\Repositories\JobSeries\Position;

interface PositionRepository
{
    public function getListPositionPaginate(?int $limit);

    public function getListLeafPosition(array $columns = ['*']);

    public function getListLeafPositionExcludeMainPositionId(
        ?int $excludeId = null,
        array $columns = ['*']
    ): mixed;
}
