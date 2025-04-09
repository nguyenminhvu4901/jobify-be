<?php

namespace App\Repositories\JobSeries\Position;

interface PositionRepository
{
    public function getListPositionPaginate(int|null $limit);
}
