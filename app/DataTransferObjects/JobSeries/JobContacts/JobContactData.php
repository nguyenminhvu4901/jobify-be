<?php

namespace App\DataTransferObjects\JobSeries\JobContacts;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class JobContactData implements DataTransferObjectInterface
{
    public function __construct(
        public int|null $jobContactId,
        public string $fullName,
        public string $email,
        public string $phoneNumber
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            jobContactId: $data['job_contact_id'] ?? null,
            fullName: $data['full_name'] ?? null,
            email: $data['email'] ?? null,
            phoneNumber: $data['phone_number'] ?? null
        );
    }
}
