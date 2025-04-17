<?php

namespace App\DataTransferObjects\JobSeries\JobContacts;

use App\DataTransferObjects\DataTransferObjectInterface;

readonly class StoreJobContactData implements DataTransferObjectInterface
{
    public function __construct(
        public string $fullName,
        public string $email,
        public string $phoneNumber
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new self(
            fullName: (string) ($data['full_name'] ?? ''),
            email: (string) ($data['email'] ?? ''),
            phoneNumber: (string) ($data['phone_number'] ?? '')
        );
    }
}
