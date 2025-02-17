<?php

namespace App\Services\UserCourse;

use App\Enums\DefaultContentType;
use App\Repositories\UserCourseResource\UserCourseResourceRepository;
use App\Services\AttachmentResource\AttachmentResourceService;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class UserCourseService
{
    use ImageHandler, VideoHandler;

    /**
     * @param AttachmentResourceService $attachmentResourceService
     * @param UserCourseResourceRepository $userCourseResourceRepository
     */
    public function __construct(
        protected AttachmentResourceService $attachmentResourceService,
        protected UserCourseResourceRepository $userCourseResourceRepository
    )
    {
    }

    /**
     * @param $attachment
     * @return void|null
     */
    public function processSaveAttachment($attachment)
    {
        $user = auth()->user();

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value) {
            $path = 'images/profiles/' . extractEmailPrefix($user->email) . '/courses';
            $pathStorage = $this->storeImage($attachment['content'], $path, $user);

        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {
            $pathStorage = $attachment['content'];

        } elseif ($attachment['content_type_id'] == DefaultContentType::VIDEO->value) {
            $path = 'videos/profiles/' . extractEmailPrefix($user->email) . '/courses';
            $pathStorage = $this->storeVideo($attachment['content'], $path, $user);

        } else {
            return null;
        }

        return $pathStorage;
    }

    /**
     * @param $attachment
     * @param $userCourseId
     * @param $pathStorage
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function storeUserCourseResource($attachment, $userCourseId, $pathStorage): mixed
    {
        return $this->userCourseResourceRepository->create([
            'user_course_id' => $userCourseId,
            'title' => $attachment['title'],
            'path' => $pathStorage,
            'description' => $attachment['description'],
            'content_type_id' => $attachment['content_type_id']
        ]);
    }
}
