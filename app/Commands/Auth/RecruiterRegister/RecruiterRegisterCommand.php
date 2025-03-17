<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Commands\Base\BaseRegister\BaseRegisterCommand;
use Illuminate\Foundation\Http\FormRequest;

class RecruiterRegisterCommand extends BaseRegisterCommand
{
    /**
     * @param string $fullName
     * @param string $email
     * @param string $password
     * @param string $phoneNumber
     * @param string $companyName
     * @param int $companyScaleId
     * @param string $taxCode
     * @param int $genderId
     * @param int $province
     * @param int $district
     */
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
        public readonly string $branchName,
        public readonly int $district
    ) {
        parent::__construct($fullName, $email, $password, $phoneNumber);
    }

    /**
     * @param FormRequest $request
     * @return RecruiterRegisterCommand
     */
    public static function withForm(FormRequest $request): RecruiterRegisterCommand
    {
        $data = array_merge(
            parent::fromBaseRequest($request),
            [
                'companyName' => $request->get('company_name'),
                'companyScaleId' => $request->get('company_scale_id'),
                'taxCode' => $request->get('tax_code'),
                'genderId' => $request->get('gender_id'),
                'branchName' => $request->get('branch_name'),
                'province' => $request->get('province'),
                'district' => $request->get('district'),
            ]
        );

        return new self(...$data);
    }
}
