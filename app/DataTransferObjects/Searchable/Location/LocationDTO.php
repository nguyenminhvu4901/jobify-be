<?php

namespace App\DataTransferObjects\Searchable\Location;

readonly class LocationDTO
{
    /**
     * @param $province
     * @return array
     */
    public static function formatProvince($province): array
    {
        return [
            'id' => $province->id,
            'code' => $province->code,
            'province_name' => $province->province_name
        ];
    }

    /**
     * @param $district
     * @return array
     */
    public static function formatDistrict($district): array
    {
        return [
            'id' => $district->id,
            'code' => $district->code,
            'district_name' => $district->district_name,
        ];
    }

    /**
     * @param $ward
     * @return array
     */
    public static function formatWard($ward): array
    {
        return [
            'id' => $ward->id,
            'code' => $ward->code,
            'ward_name' => $ward->ward_name
        ];
    }
}
