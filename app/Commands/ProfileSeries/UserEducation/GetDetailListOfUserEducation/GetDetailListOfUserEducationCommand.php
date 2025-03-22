<?php

namespace App\Commands\ProfileSeries\UserEducation\GetDetailListOfUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserEducationCommand implements CommandInterface
{
    /**
     * @param int|string $userEducationId
     */
    public function __construct(
        public int|string $userEducationId
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
            userEducationId: $request->get('user_education_id')
        );
    }
}
