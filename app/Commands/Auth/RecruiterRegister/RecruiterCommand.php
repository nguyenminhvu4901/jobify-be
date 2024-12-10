<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class RecruiterCommand implements CommandInterface
{
    public function __construct(
        public readonly string $fullName,
        public readonly string $email,
        public readonly string $password,
        public readonly string $phoneNumber,
        public readonly int $genderId,
        public readonly string $companyName,
        public readonly int $companyScaleId,
        public readonly string $taxCode,
        public readonly int $province,
        public readonly int $district
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            fullName: $request->get('full_name'),
            email: $request->get('email'),
            password: $request->get('password'),
            phoneNumber: $request->get('phone_number'),
            genderId: $request->get('gender_id'),
            companyName: $request->get('company_name'),
            companyScaleId: $request->get('company_scale_id'),
            taxCode: $request->get('tax_code'),
            province: $request->get('province'),
            district: $request->get('district')
        );
    }
}
