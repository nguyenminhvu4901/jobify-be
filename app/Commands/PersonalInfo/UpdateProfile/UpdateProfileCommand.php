<?php

namespace App\Commands\PersonalInfo\UpdateProfile;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateProfileCommand implements CommandInterface
{
    public function __construct(
        public ?string         $fullName,
        public ?string         $phoneNumber,
        public ?string         $position,
        public int|string|null $gender,
        public ?string         $birthDate,
        public string|null     $description
    )
    {}

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            fullName: $request->get('full_name'),
            phoneNumber: $request->get('phone_number'),
            position: $request->get('position'),
            gender: $request->get('gender_id') ?? null,
            birthDate: $request->get('birth_date'),
            description: $request->get('profile_description') ?? null
        );
    }
}
