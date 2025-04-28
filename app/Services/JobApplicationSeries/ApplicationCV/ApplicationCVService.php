<?php

namespace App\Services\JobApplicationSeries\ApplicationCV;

use App\Entities\JobApplicationSeries\JobApplication\JobApplication;
use App\Repositories\JobApplicationSeries\ApplicationCV\ApplicationCVRepository;
use App\Repositories\User\UserRepository;
use App\Traits\ImageHandler;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ApplicationCVService
{
    use ImageHandler;

    /**
     * @param ApplicationCVRepository $applicationCVRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected ApplicationCVRepository $applicationCVRepository,
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param JobApplication $jobApplication
     * @return array
     */
    public function processSaveCV(UploadedFile $uploadedFile, JobApplication $jobApplication): array
    {
        $filenameWithoutExtension = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileNameSlug = Str::slug($filenameWithoutExtension);

        $pathFile = $this->storeFileCV($uploadedFile, $jobApplication);

        return $this->applicationCVRepository->storeDataWithTransaction([
            'title' => $fileNameSlug,
            'path' => $pathFile,
            'job_application_id' => $jobApplication->id
        ]);
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param JobApplication $jobApplication
     * @return string|null
     */
    private function storeFileCV(
        UploadedFile $uploadedFile, JobApplication $jobApplication
    ): ?string
    {
        $user = $this->userRepository->find($jobApplication->user_id);

        $path = 'files/cv/' . $jobApplication?->jobListings?->slug . '/' . extractEmailPrefix($user->email);

        return $this->storeImage($uploadedFile, $path, $user);
    }
}
