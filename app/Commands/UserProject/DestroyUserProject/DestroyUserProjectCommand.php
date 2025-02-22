<?php

namespace App\Commands\UserProject\DestroyUserProject;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserProjectCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     * @param int $userProjectId
     */
    public function __construct(
        public string $userSlug,
        public int    $userProjectId,
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userProjectId: $request->get('user_project_id')
        );
    }
}
