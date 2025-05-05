<?php

namespace App\DataTransferObjects\Searchable\Default;

readonly class RateDTO
{
    /**
     * @param $rate
     * @return array
     */
    public static function formatRate($rate): array
    {
        return [
            'id' => $rate->id,
            'rate' => $rate->rate
        ];
    }
}
