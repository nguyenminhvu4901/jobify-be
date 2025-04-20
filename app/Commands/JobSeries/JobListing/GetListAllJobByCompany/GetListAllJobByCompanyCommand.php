<?php

namespace App\Commands\JobSeries\JobListing\GetListAllJobByCompany;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListAllJobByCompanyCommand implements CommandInterface
{
    public function __construct(
        public int $companyId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyId: $request->input('company_id')
        );
    }
}
