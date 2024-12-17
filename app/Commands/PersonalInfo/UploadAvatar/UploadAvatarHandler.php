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
        $path = config('constants.path_avatar');

        if(!empty($command->avatar)){
            $pathStorage = $this->storeImage($command->avatar, $path, $user);

            return $this->userRepository->update([
                'avatar' => $pathStorage
            ], $user->id);
        }else{
            $status = $this->deleteImage($path, $user);

            if($status){
                return $this->userRepository->update([
                    'avatar' => config('constants.default_avatar')
                ], $user->id);
            }

            return null;
        }
    }
}
