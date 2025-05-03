<?php

namespace App\Commands\ProfileSeries\UserLocation\GetDetailListOfUserLocation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserLocationCommand implements CommandInterface
{
    public function __construct(
        public int|string $userLocationId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userLocationId: $request->get('user_location_id')
        );
    }
}
