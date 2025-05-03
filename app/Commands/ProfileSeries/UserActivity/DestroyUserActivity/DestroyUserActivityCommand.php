<?php

namespace App\Commands\ProfileSeries\UserActivity\DestroyUserActivity;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserActivityCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public string|int $userActivityId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userActivityId: $request->get('user_activity_id')
        );
    }
}
