<?php

namespace App\Commands\CompanySeries\CompanyBranch\DestroyCompanyBranch;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyCompanyBranchCommand implements CommandInterface
{
    public function __construct(
        public string|int $companyBranchId,
        public string|int $companyId,
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyBranchId: $request->input('company_branch_id'),
            companyId: $request->input('company_id'),
        );
    }
}
