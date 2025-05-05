<?php

namespace App\DataTransferObjects\Searchable\JobSeries\Currencies;

readonly class CurrencyDTO
{
    /**
     * @param $currency
     * @return array
     */
    public static function formatCurrency($currency): array
    {
        return [
            'id' => $currency->id,
            'name' => $currency->name
        ];
    }
}
