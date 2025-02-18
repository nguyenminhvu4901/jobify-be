<?php

namespace App\Commands\PersonalInfo\UploadAvatar;

use App\Http\Resources\UserProfile\UserProfileResource;
use App\Repositories\User\UserRepository;
use App\Traits\ImageHandler;

class UploadAvatarHandler
{
    use ImageHandler;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    ){}

    /**
     * @param UploadAvatarCommand $command
     * @return array
     */
    public function handle(UploadAvatarCommand $command): array
    {
        try {
            $user = auth()->user();

            if(!empty($command->avatar)){
                if(is_string($command->avatar)){
                    if($command->avatar == $user->avatar){
                        $userInfo = $this->userRepository->find($user->id);
                    }else{
                        $userInfo = $this->processAvatarDefault($user);
                    }
                }else{
                    $path = config('constants.path_avatar');

                    $pathStorage = $this->storeImage($command->avatar, $path, $user);

                    $userInfo = $this->userRepository->update([
                        'avatar' => $pathStorage
                    ], $user->id);
                }
            }else{
                $userInfo = $this->processAvatarDefault($user);
            }

            if(!empty($userInfo)){
                return [
                    'user' => UserProfileResource::make($userInfo->refresh()),
                    'message' => __('messages.profile.user_update_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_update_profile_error'),
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    /**
     * @param $userInfo
     * @return mixed
     */
    private function processAvatarDefault($userInfo): mixed
    {
        $status = $this->deleteImage($userInfo->avatar);

        if($status){
            return $this->userRepository->update([
                'avatar' => asset(config('constants.default_avatar'))
            ], $userInfo->id);
        }

        return null;
    }
}
