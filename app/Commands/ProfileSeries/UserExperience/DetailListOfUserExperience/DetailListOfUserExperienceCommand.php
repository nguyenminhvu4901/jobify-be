<?php

namespace App\Commands\ProfileSeries\UserExperience\DetailListOfUserExperience;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DetailListOfUserExperienceCommand implements CommandInterface
{
    /**
     * @param string|int $userExperienceId
     */
    public function __construct(
        public string|int $userExperienceId
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
            userExperienceId: $request->get('user_experience_id')
        );
    }
}
