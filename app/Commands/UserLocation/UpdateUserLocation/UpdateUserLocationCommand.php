<?php

namespace App\Commands\UserLocation\UpdateUserLocation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateUserLocationCommand implements CommandInterface
{
    public function __construct(
        public string|int $userLocationId,
        public string|int|null $provinceId,
        public string|int|null $districtId,
        public string|int|null $wardId,
        public string|null $address,
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userLocationId: $request->input('user_location_id'),
            provinceId: $request->input('province_id') ?? null,
            districtId: $request->input('district_id') ?? null,
            wardId: $request->input('ward_id') ?? null,
            address: $request->input('address') ?? null
        );
    }
}
