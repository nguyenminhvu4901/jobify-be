<?php

namespace App\Repositories\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\JobContact;
use App\Repositories\BaseRepository;

class JobContactRepositoryEloquent extends BaseRepository implements JobContactRepository
{
    public function model()
    {
       return JobContact::class;
    }
}
