<?php

namespace App\Repositories\JobSeries\Currency;

use App\Entities\JobSeries\Currency\Currency;
use App\Repositories\BaseRepository;

class CurrencyRepositoryEloquent extends BaseRepository implements CurrencyRepository
{
    public function model(): string
    {
        return Currency::class;
    }
}
