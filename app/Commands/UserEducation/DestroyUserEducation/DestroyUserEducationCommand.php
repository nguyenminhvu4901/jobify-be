<?php

namespace App\Commands\UserEducation\DestroyUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserEducationCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     * @param int|string $userEducationId
     */
    public function __construct(
        public string     $userSlug,
        public int|string $userEducationId,
    )
    {}

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userEducationId: $request->get('user_education_id')
        );
    }
}
