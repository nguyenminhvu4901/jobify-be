<?php

namespace App\Commands\CompanySeries\CompanyBranch\GetListCompanyBranch;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListCompanyBranchCommand implements CommandInterface
{
    public function __construct(
        public string|int $companyId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyId: $request->input('company_id')
        );
    }
}
