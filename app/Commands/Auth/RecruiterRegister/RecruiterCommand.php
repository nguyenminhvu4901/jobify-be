<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Commands\Base\BaseRegister\BaseRegisterCommand;
use Illuminate\Foundation\Http\FormRequest;

class RecruiterCommand extends BaseRegisterCommand
{
    public function __construct(
        string $fullName,
        string $email,
        string $password,
        string $phoneNumber,
        public readonly string $companyName,
        public readonly int $companyScaleId,
        public readonly string $taxCode,
        public readonly int $genderId,
        public readonly int $province,
        public readonly int $district
    ) {
        parent::__construct($fullName, $email, $password, $phoneNumber);
    }

    /**
     * Tạo RecruiterCommand từ FormRequest
     */
    public static function withForm(FormRequest $request): RecruiterCommand
    {
        $data = array_merge(
            parent::fromBaseRequest($request),
            [
                'companyName' => $request->get('company_name'),
                'companyScaleId' => $request->get('company_scale_id'),
                'taxCode' => $request->get('tax_code'),
                'genderId' => $request->get('gender_id'),
                'province' => $request->get('province'),
                'district' => $request->get('district'),
            ]
        );

        return new self(...$data);
    }
}
