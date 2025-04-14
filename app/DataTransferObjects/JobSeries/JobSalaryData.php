<?php

namespace App\DataTransferObjects\JobSeries;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class JobSalaryData implements DataTransferObjectInterface
{
    public function __construct(
        public int $currencyId,
        public int $jobSalaryTypeId,
        public string|null $from,
        public string|null $to
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            currencyId: (int) $data['currency_id'],
            jobSalaryTypeId: (int) $data['job_salary_type_id'],
            from: $data['from'] ?? null,
            to: $data['to'] ?? null
        );
    }
}
