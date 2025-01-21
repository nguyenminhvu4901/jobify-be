<?php

namespace App\Commands\PersonalInfo\UploadAvatar;

use App\Repositories\User\UserRepository;
use App\Traits\ImageHandler;

class UploadAvatarHandler
{
    use ImageHandler;

    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function handle(UploadAvatarCommand $command)
    {
        $user = auth()->user();

        if(!empty($command->avatar)){
            if(is_string($command->avatar)){
                if($command->avatar == $user->avatar){
                    return $this->userRepository->find(auth()->user()->id);
                }else{
                    return $this->processAvatarDefault($user);
                }
            }else{
                $path = config('constants.path_avatar');

                $pathStorage = $this->storeImage($command->avatar, $path, $user);

                return $this->userRepository->update([
                    'avatar' => $pathStorage
                ], $user->id);
            }
        }else{
            return $this->processAvatarDefault($user);
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
