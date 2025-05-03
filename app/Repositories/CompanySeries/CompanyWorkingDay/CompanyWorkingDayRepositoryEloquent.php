<?php

namespace App\Repositories\CompanySeries\CompanyWorkingDay;

use App\Entities\CompanySeries\CompanyWorkingDay\CompanyWorkingDay;
use App\Repositories\BaseRepository;

class CompanyWorkingDayRepositoryEloquent extends BaseRepository implements CompanyWorkingDayRepository
{
    public function model(): string
    {
        return CompanyWorkingDay::class;
    }
}
