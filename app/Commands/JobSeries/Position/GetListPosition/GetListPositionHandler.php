<?php

namespace App\Commands\JobSeries\Position\GetListPosition;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Http\Resources\JobSeries\Position\PositionResource;
use App\Repositories\JobSeries\Position\PositionRepository;
use Illuminate\Support\Facades\Cache;

class GetListPositionHandler
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
     * @param GetListPositionCommand $command
     * @return array
     */
    public function handle(GetListPositionCommand $command): array
    {
        try {
            $cache = Cache::tags([PositionEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        PositionEnum::LIST_ALL_POSITION->value,
                        $command
                    )
                );

            $positions = Cache::tags([PositionEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    PositionEnum::LIST_ALL_POSITION->value,
                    $command
                ),
                CacheTTL::HARD->value,
                fn() => $this->positionRepository->getListPositionPaginate($command->limit)
            );

            return [
                'data' => PositionResource::collection($positions),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatCursorPaginationData($positions)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
