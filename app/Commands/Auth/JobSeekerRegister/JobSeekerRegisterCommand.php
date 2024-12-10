<?php

namespace App\Commands\Auth\JobSeekerRegister;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class JobSeekerRegisterCommand implements CommandInterface
{
    public function __construct(
        public readonly string $fullName,
        public readonly string $email,
        public readonly string $password,
        public readonly string $phoneNumber,
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            fullName: $request->get('full_name'),
            email: $request->get('email'),
            password: $request->get('password'),
            phoneNumber: $request->get('phone_number')
        );
    }
}
