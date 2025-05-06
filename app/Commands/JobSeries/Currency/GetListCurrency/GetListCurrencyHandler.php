<?php

namespace App\Commands\JobSeries\Currency\GetListCurrency;

use App\Enums\RouteNames\JobSeries\CurrencyEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\Currency\CurrencyResource;
use App\Repositories\JobSeries\Currency\CurrencyRepository;
use Illuminate\Support\Facades\Cache;

class GetListCurrencyHandler
{
    /**
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(
        protected CurrencyRepository $currencyRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = redisHardCacheDB()->tags([CurrencyEnum::TAG_NAME->value])->has(
                CurrencyEnum::LIST_ALL_CURRENCY->value);

            $currencies = redisHardCacheDB()->tags([CurrencyEnum::TAG_NAME->value])
                ->remember(
                    CurrencyEnum::LIST_ALL_CURRENCY->value,
                    CacheTTL::HARD->value,
                    fn() => $this->currencyRepository->get()
                );

            return [
                'data' => CurrencyResource::collection($currencies),
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
