<?php

namespace App\Commands\CompanySeries\CompanyProfile\UpdateCompanyProfile;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateCompanyProfileCommand implements CommandInterface
{
    public function __construct(
        public string|int $userId,
        public string|int $companyId,
        public string $companyName,
        public string|int $companyScaleId,
        public string|int $genderId,
        public string|int|null $companyWorkingDayId,
        public ?string $website,
        public ?string $description,
        public string|int|null $taxCode,
        public ?array $operationTypes,
        public ?array $businessSectors,
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userId: $request->input('user_id'),
            companyId: $request->input('company_id'),
            companyName: $request->input('company_name'),
            companyScaleId: $request->input('company_scale_id'),
            genderId: $request->input('gender_id'),
            companyWorkingDayId: $request->input('company_working_day_id'),
            website: $request->input('website'),
            description: $request->input('description'),
            taxCode: $request->input('tax_code'),
            operationTypes: $request->input('operation_types'),
            businessSectors: $request->input('business_sectors')
        );
    }
}
