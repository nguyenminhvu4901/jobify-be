<?php

namespace App\Commands\JobApplicationSeries\JobApplication\StoreJobSeekerApplyJob;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

readonly class StoreJobSeekerApplyJobCommand implements CommandInterface
{
    public function __construct(
        public int $userId,
        public int $jobListingId,
        public string $fullName,
        public string $email,
        public string $phoneNumber,
        public ?string $coverLetter,
        public UploadedFile $applicationCV
    ) {
    }

    public static function withForm(FormRequest $request): self
    {
        return new self(
            userId: (int) $request->input('user_id'),
            jobListingId: (int) $request->input('job_listing_id'),
            fullName: (string) $request->input('full_name'),
            email: (string) $request->input('email'),
            phoneNumber: (string) $request->input('phone_number'),
            coverLetter: $request->input('cover_letter'),
            applicationCV: $request->file('application_cv')
        );
    }
}
