<?php

namespace App\DataTransferObjects\JobSeries\JobLocations;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class StoreJobLocationData implements DataTransferObjectInterface
{
    /**
     * @param string $branchName
     * @param int $provinceId
     * @param int $districtId
     * @param int|null $wardId
     * @param string|null $address
     */
    public function __construct(
        public string $branchName,
        public int $provinceId,
        public int $districtId,
        public int|null $wardId,
        public string|null $address
    )
    {
    }


    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new self(
            branchName: $data['branch_name'],
            provinceId: (int) $data['province_id'],
            districtId: (int) $data['district_id'],
            wardId: $data['ward_id'] ?? null,
            address: $data['address'] ?? null,
        );
    }
}
