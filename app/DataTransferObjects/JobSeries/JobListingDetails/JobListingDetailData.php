<?php

namespace App\DataTransferObjects\JobSeries\JobListingDetails;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class JobListingDetailData implements DataTransferObjectInterface
{
    public function __construct(
        public int|null $jobListingDetailId,
        public string|null $description,
        public string|null $requirement,
        public string|null $income,
        public string|null $benefit,
        public string|null $working_hour
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
            jobListingDetailId: $data['job_listing_detail_id'] ?? null,
            description: $data['description'] ?? null,
            requirement: $data['requirement'] ?? null,
            income: $data['income'] ?? null,
            benefit: $data['benefit'] ?? null,
            working_hour: $data['working_hour'] ?? null,
        );
    }
}
