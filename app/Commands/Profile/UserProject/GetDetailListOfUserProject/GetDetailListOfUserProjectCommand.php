<?php

namespace App\Commands\Profile\UserProject\GetDetailListOfUserProject;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserProjectCommand implements CommandInterface
{
    public function __construct(
        public int|string $userProjectId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userProjectId: $request->get('user_project_id')
        );
    }
}
