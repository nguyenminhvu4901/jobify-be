<?php

namespace App\Commands\UserProject\GetDetailListOfUserProject;

use App\Repositories\UserProject\UserProjectRepository;

class GetDetailListOfUserProjectHandle
{
    public function __construct(
        protected UserProjectRepository $userProjectRepository
    )
    {
    }

    public function handle(GetDetailListOfUserProjectCommand $command)
    {

    }
}
