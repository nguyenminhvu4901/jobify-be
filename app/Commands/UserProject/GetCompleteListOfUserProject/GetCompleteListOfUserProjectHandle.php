<?php

namespace App\Commands\UserProject\GetCompleteListOfUserProject;

use App\Repositories\UserProject\UserProjectRepository;

class GetCompleteListOfUserProjectHandle
{
    public function __construct(
        protected UserProjectRepository $userProjectRepository
    )
    {
    }

    public function handle()
    {

    }
}
