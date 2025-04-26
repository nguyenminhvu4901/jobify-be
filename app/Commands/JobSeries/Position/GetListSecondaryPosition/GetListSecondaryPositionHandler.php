<?php

namespace App\Commands\JobSeries\Position\GetListSecondaryPosition;

use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\Position\LeafPositionResource;
use App\Repositories\JobSeries\Position\PositionRepository;
use Illuminate\Support\Facades\Cache;

class GetListSecondaryPositionHandler
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
     * @param GetListSecondaryPositionCommand $command
     * @return array
     */
    public function handle(GetListSecondaryPositionCommand $command): array
    {
        try {
            $cache = Cache::tags([PositionEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        PositionEnum::LIST_SECONDARY_POSITION->value,
                        $command
                    )
                );

            $subPositions = Cache::tags([PositionEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    PositionEnum::LIST_SECONDARY_POSITION->value,
                    $command
                ),
                CacheTTL::HARD->value,
                fn() => $this->positionRepository
                    ->getListLeafPositionExcludeMainPositionId(
                        $command->mainPositionId,
                        ['id', 'name']
                    )
            );

            return [
                'data' => LeafPositionResource::collection($subPositions),
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
