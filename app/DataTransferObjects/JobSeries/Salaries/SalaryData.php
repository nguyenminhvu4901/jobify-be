<?php

namespace App\DataTransferObjects\JobSeries\Salaries;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class SalaryData implements DataTransferObjectInterface
{
    /**
     * @param int|null $salaryId
     * @param int|string $currencyId
     * @param int|string $jobSalaryTypeId
     * @param string|null $from
     * @param string|null $to
     */
    public function __construct(
        public int|null $salaryId,
        public int|string $currencyId,
        public int|string $jobSalaryTypeId,
        public string|null $from,
        public string|null $to
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
            salaryId: $data['salary_id'] ?? null,
            currencyId: (int) $data['currency_id'],
            jobSalaryTypeId: (int) $data['job_salary_type_id'],
            from: $data['from'] ?? null,
            to: $data['to'] ?? null
        );
    }
}
