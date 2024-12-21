<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Services\UserExperience\UserExperienceService;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

class UpdateUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository,
        protected UserExperienceResourceRepository $userExperienceResourceRepository,
        protected UserExperienceService $userExperienceService
    )
    {
    }

    public function handle(UpdateUserExperienceCommand $command)
    {
        $userExperience = $this->userExperienceRepository->findByRelationshipUserSlugAndColumnDetailId(
            $command->userSlug, $command->userExperienceId
        );

        if($userExperience)
        {
            DB::beginTransaction();

            try {
                $userExperience =  $this->userExperienceRepository->update([
                    'name' => $command->name,
                    'position' => $command->position,
                    'is_working' => $command->isWorking,
                    'start_date' => $command->startDate,
                    'end_date' => $command->endDate
                ], $command->userExperienceId);

                DB::commit();
            }catch (\Exception $e){
                DB::rollBack();

                return null;
            }

            if(!empty($userExperience))
            {
                if(!empty($command->attachments))
                {
                    $attachments = $command->attachments;

                    $this->deleteExcessUserExperienceResource($attachments, $userExperience);

                    $this->processAttachmentAndSaveUserExpensiveResource($attachments, $userExperience);
                }
            }

            return $userExperience;
        }

        return null;
    }

    /**
     * @param $attachments
     * @param $userExperience
     * @return void
     * @throws ValidatorException
     */
    private function processAttachmentAndSaveUserExpensiveResource($attachments, $userExperience): void
    {

        foreach ($attachments as $attachment)
        {
            if(!empty($attachment['user_experience_resource_id']))
            {
                $userExperienceResource = $this->userExperienceResourceRepository
                    ->find($attachment['user_experience_resource_id']);

                $pathStorage = $this->userExperienceService->processUpdateAttachment(
                    $attachment, $userExperienceResource
                );

                if(!empty($pathStorage))
                {
                    $userExperienceResource->update([
                        'user_experience_id' => $userExperience->id,
                        'title' => $attachment['title'],
                        'path' => $pathStorage,
                        'description' => $attachment['description'],
                        'content_type_id' => $attachment['content_type_id']
                    ]);
                }
            }else{
                $pathStorage = $this->userExperienceService->processStoreAttachment($attachment);

                if(!empty($pathStorage))
                {
                    $this->userExperienceResourceRepository->create([
                        'user_experience_id' => $userExperience->id,
                        'title' => $attachment['title'],
                        'path' => $pathStorage,
                        'description' => $attachment['description'],
                        'content_type_id' => $attachment['content_type_id']
                    ]);
                }
            }
        }
    }

    /**
     * @param $attachments
     * @param $userExperience
     * @return void
     */
    private function deleteExcessUserExperienceResource($attachments, $userExperience): void
    {
        $idsToDelete = $this->getListExcessUserExperienceResourceId($attachments, $userExperience);

        $userExperienceResources = $this->userExperienceResourceRepository->getListUserExperienceResourceByIds($idsToDelete);

        foreach ($userExperienceResources as $userExperienceResource)
        {
            $this->userExperienceService->processDeleteAttachment($userExperienceResource);
            $userExperienceResource->delete();
        }
    }

    /**
     * @param $attachments
     * @param $userExperience
     * @return mixed
     */
    private function getListExcessUserExperienceResourceId($attachments, $userExperience): mixed
    {
        $userExperienceResourceIds = $userExperience->userExperienceResource()->pluck('id')->toArray();

        $newAttachmentRequestIds = array_values(
            array_filter(
                array_column($attachments, 'user_experience_resource_id'),
                fn($id) => !is_null($id)
            )
        );

        return array_diff($userExperienceResourceIds, $newAttachmentRequestIds);
    }


}
