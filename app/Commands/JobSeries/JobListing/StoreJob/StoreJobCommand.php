<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Commands\CommandInterface;
use App\DataTransferObjects\JobSeries\JobSalaryData;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreJobCommand implements CommandInterface
{
    public function __construct(
        public int $companyId,
        public string $title,
        public int $quantityRecruitment,
        public int $genderId,
        public Carbon $publishDate,
        public Carbon $expiryDate,

        /** @var JobSalaryData[]|null */
        public array|null $jobSalaries,

//        public int|null $jobTypeId,
//        public int|null $jobLevelId,
//        public int|null $jobExperienceId,
//        public int|null $jobAgeRangeId,
//        public int|null $jobEducationLevelId,
//
//        public array $jobLocations,
//        public array $jobPositions,
//        public array $jobContacts,
//        public array $jobListingDetails,
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $jobSalaries = $request->input('job_salaries');

       return new self(
           companyId: $request->input('company_id'),
           title: $request->input('title'),
           quantityRecruitment: $request->input('quantity_recruitment'),
           genderId: $request->input('gender_id'),
           publishDate: Carbon::parse($request->input('publish_date')),
           expiryDate: Carbon::parse($request->input('expiry_date')),

           jobSalaries: $jobSalaries
               ? collect($jobSalaries)
                   ->map(fn ($item) => JobSalaryData::fromArray($item))
                   ->all()
               : null,
       );
    }
}
