<?php

namespace App\Commands\Profile\UserLocation\DestroyUserLocation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserLocationCommand implements CommandInterface
{
    public function __construct(
        public string     $userSlug,
        public int|string $userLocationId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->input('user_slug'),
            userLocationId: $request->input('user_location_id')
        );
    }
}
