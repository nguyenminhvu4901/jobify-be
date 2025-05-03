<?php

namespace App\DataTransferObjects\JobSeries\JobLocations;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class JobLocationData implements DataTransferObjectInterface
{
    public function __construct(
        public ?int $jobLocationId,
        public string $branchName,
        public int $provinceId,
        public int $districtId,
        public ?int $wardId,
        public ?string $address
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            jobLocationId: $data['job_location_id'] ?? null,
            branchName: $data['branch_name'],
            provinceId: (int) $data['province_id'],
            districtId: (int) $data['district_id'],
            wardId: $data['ward_id'] ?? null,
            address: $data['address'] ?? null,
        );
    }
}
