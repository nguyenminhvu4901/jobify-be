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
        $fileName = $this->generateSlugFilename($uploadedFile);
        $filePath = $this->storeFileCV($uploadedFile, $jobApplication);

        return $this->applicationCVRepository->storeDataWithTransaction([
            'title' => $fileName,
            'path' => $filePath,
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

        $path = sprintf(
            'files/cv/%s/%s',
            $jobApplication?->jobListings?->slug,
            extractEmailPrefix($user->email)
        );

        return $this->storeImage($uploadedFile, $path, $user);
    }

    /**
     *
     * @param UploadedFile $uploadedFile
     * @return string
     */
    private function generateSlugFilename(UploadedFile $uploadedFile): string
    {
        $filenameWithoutExtension = pathinfo(
            $uploadedFile->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        return Str::slug($filenameWithoutExtension);
    }
}
