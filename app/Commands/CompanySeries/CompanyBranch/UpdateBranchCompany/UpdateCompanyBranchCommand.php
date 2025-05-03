<?php

namespace App\Commands\CompanySeries\CompanyBranch\UpdateBranchCompany;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateCompanyBranchCommand implements CommandInterface
{
    public function __construct(
        public string|int $companyBranchId,
        public string|int $companyId,
        public string $branchName,
        public string|int $provinceId,
        public string|int $districtId,
        public string|int|null $wardId,
        public ?string $address
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyBranchId: $request->input('company_branch_id'),
            companyId: $request->input('company_id'),
            branchName: $request->input('branch_name'),
            provinceId: $request->input('province_id'),
            districtId: $request->input('district_id'),
            wardId: $request->input('ward_id'),
            address: $request->input('address')
        );
    }
}
