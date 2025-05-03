<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Commands\Base\BaseRegister\BaseRegisterCommand;
use Illuminate\Foundation\Http\FormRequest;

class RecruiterRegisterCommand extends BaseRegisterCommand
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
        public readonly int $provinceId,
        public readonly string $branchName,
        public readonly int $districtId
    ) {
        parent::__construct($fullName, $email, $password, $phoneNumber);
    }

    public static function withForm(FormRequest $request): RecruiterRegisterCommand
    {
        $data = array_merge(
            parent::fromBaseRequest($request),
            [
                'companyName' => $request->input('company_name'),
                'companyScaleId' => $request->input('company_scale_id'),
                'taxCode' => $request->input('tax_code'),
                'genderId' => $request->input('gender_id'),
                'branchName' => $request->input('branch_name'),
                'provinceId' => $request->input('province_id'),
                'districtId' => $request->input('district_id'),
            ]
        );

        return new self(...$data);
    }
}
