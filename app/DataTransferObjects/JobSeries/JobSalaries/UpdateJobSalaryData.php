<?php

namespace App\DataTransferObjects\JobSeries\JobSalaries;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class UpdateJobSalaryData implements DataTransferObjectInterface
{
    public function __construct(
        public int $jobSalaryId,
        public int|string $currencyId,
        public int|string $jobSalaryTypeId,
        public string|null $from,
        public string|null $to
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            jobSalaryId: $data['job_salary_id'],
            currencyId: (int) $data['currency_id'],
            jobSalaryTypeId: (int) $data['job_salary_type_id'],
            from: $data['from'] ?? null,
            to: $data['to'] ?? null
        );
    }
}
