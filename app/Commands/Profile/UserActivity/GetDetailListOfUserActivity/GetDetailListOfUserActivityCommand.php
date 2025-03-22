<?php

namespace App\Commands\Profile\UserActivity\GetDetailListOfUserActivity;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserActivityCommand implements CommandInterface
{
    public function __construct(
        public int|string $userActivityId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userActivityId: $request->get('user_activity_id')
        );
    }
}
