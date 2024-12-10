<?php

namespace App\Commands\Base\BaseRegister;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRegisterCommand implements CommandInterface
{
    public function __construct(
        public readonly string $fullName,
        public readonly string $email,
        public readonly string $password,
        public readonly string $phoneNumber
    ) {}
    
    public static function fromBaseRequest(FormRequest $request): array
    {
        return [
            'fullName' => $request->get('full_name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'phoneNumber' => $request->get('phone_number'),
        ];
    }
}
