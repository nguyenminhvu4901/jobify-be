<?php

namespace App\Commands\ProfileSeries\UserLocation\StoreUserLocation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserLocationCommand implements CommandInterface
{
    public function __construct(
        public string|int|null $provinceId,
        public string|int|null $districtId,
        public string|int|null $wardId,
        public ?string $address,
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            provinceId: $request->input('province_id') ?? null,
            districtId: $request->input('district_id') ?? null,
            wardId: $request->input('ward_id') ?? null,
            address: $request->input('address') ?? null
        );
    }
}
