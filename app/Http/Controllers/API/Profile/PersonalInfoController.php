<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\PersonalInfo\UpdateProfile\UpdateProfileCommand;
use App\Commands\PersonalInfo\UpdateProfile\UpdateProfileHandler;
use App\Commands\PersonalInfo\UploadAvatar\UploadAvatarCommand;
use App\Commands\PersonalInfo\UploadAvatar\UploadAvatarHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateUserProfileAvatarRequest;
use App\Http\Requests\Profile\UpdateUserProfileRequest;
use App\Http\Resources\Auth\JobSeekerRegisterResource;
use App\Http\Resources\UserProfile\UserProfileResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class PersonalInfoController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {}

    /**
     * @param UpdateUserProfileRequest $request
     * @return JsonResponse
     */
    public function updateProfile(UpdateUserProfileRequest $request): JsonResponse
    {
        $this->bus->addHandler(UpdateProfileCommand::class, UpdateProfileHandler::class);

        $user = $this->bus->dispatch(UpdateProfileCommand::withForm($request));

        return $user ?
            $this->responseSuccess(UserProfileResource::make($user),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }

    /**
     * @param UpdateUserProfileAvatarRequest $request
     * @return JsonResponse
     */
    public function uploadAvatar(UpdateUserProfileAvatarRequest $request): JsonResponse
    {
        $this->bus->addHandler(UploadAvatarCommand::class, UploadAvatarHandler::class);

        $user = $this->bus->dispatch(UploadAvatarCommand::withForm($request));

        return $user ?
            $this->responseSuccess(UserProfileResource::make($user),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }
}
