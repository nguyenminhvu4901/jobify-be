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
            $path = config('constants.path_avatar');

            $pathStorage = $this->storeImage($command->avatar, $path, $user);

            return $this->userRepository->update([
                'avatar' => $pathStorage
            ], $user->id);
        }else{
            $status = $this->deleteImage($user->avatar);

            if($status){
                return $this->userRepository->update([
                    'avatar' => asset(config('constants.default_avatar'))
                ], $user->id);
            }

            return null;
        }
    }
}
