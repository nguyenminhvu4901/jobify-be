<?php

namespace App\Commands\JobSeries\Position\GetListLeafPosition;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Http\Resources\JobSeries\Position\LeafPositionResource;
use App\Http\Resources\JobSeries\Position\PositionResource;
use App\Repositories\JobSeries\Position\PositionRepository;
use Illuminate\Support\Facades\Cache;

class GetListLeafPositionHandler
{
    /**
     * @param PositionRepository $positionRepository
     */
    public function __construct(
        protected PositionRepository $positionRepository
    )
    {
    }

    /**
     * @param GetListLeafPositionCommand $command
     * @return array
     */
    public function handle(GetListLeafPositionCommand $command): array
    {
        try {
            $cache = Cache::tags([PositionEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        PositionEnum::LIST_LEAF_POSITION->value,
                        $command
                    )
                );

            $positions = Cache::tags([PositionEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    PositionEnum::LIST_LEAF_POSITION->value,
                    $command
                ),
                CacheTTL::HARD->value,
                fn() => $this->positionRepository
                    ->getListLeafPosition(
                        ['id', 'name']
                    )
            );

            return [
                'data' => LeafPositionResource::collection($positions),
                'message' => __('messages.job.job_get_info_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_get_info_error'),
                'error' => $e
            ];
        }
    }
}
