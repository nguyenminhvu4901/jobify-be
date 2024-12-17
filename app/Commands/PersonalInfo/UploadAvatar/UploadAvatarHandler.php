<?php

namespace App\Commands\PersonalInfo\UploadAvatar;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadAvatarHandler
{
    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function handle(UploadAvatarCommand $command)
    {
        $user = auth()->user();
        $path = config('constants.path_avatar');

        if(!empty($command->avatar)){
            $prefixEmail = extractEmailPrefix($user->email);

            $fileName = $prefixEmail . Str::random().'.'.$command->avatar->extension();

            $command->avatar->storeAs('public/'.$path.'/'.$fileName);
            $pathStorage = asset('storage/'.$path.'/'.$fileName);

            return $this->userRepository->update([
                'avatar' => $pathStorage
            ], $user->id);
        }else{
            $fileName = basename(parse_url($user->avatar, PHP_URL_PATH));
            Storage::disk('public')->delete($path.'/'.$fileName);

            return $this->userRepository->update([
                'avatar' => config('constants.default_avatar')
            ], $user->id);
        }
    }
}
