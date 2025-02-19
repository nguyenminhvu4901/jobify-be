<?php

namespace App\Commands\UserProject\GetListProjectCurrentUser;

use App\Repositories\UserProject\UserProjectRepository;

class GetListProjectCurrentUserHandle
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
