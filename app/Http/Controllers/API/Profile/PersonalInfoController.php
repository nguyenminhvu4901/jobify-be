<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\PersonalInfo\GetCurrentUser\GetCurrentUserCommand;
use App\Commands\PersonalInfo\GetCurrentUser\GetCurrentUserHandler;
use App\Commands\PersonalInfo\UpdateProfile\UpdateProfileCommand;
use App\Commands\PersonalInfo\UpdateProfile\UpdateProfileHandler;
use App\Commands\PersonalInfo\UploadAvatar\UploadAvatarCommand;
use App\Commands\PersonalInfo\UploadAvatar\UploadAvatarHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateUserProfileAvatarRequest;
use App\Http\Requests\Profile\UpdateUserProfileRequest;
use App\Http\Resources\Auth\CurrentUserInfoResource;
use App\Http\Resources\UserProfile\UserProfileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="PersonalInfo",
 *     description="Common Profile And Avatar"
 * )
 */
class PersonalInfoController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    public function index(Request $request)
    {

    }

    /**
     * @OA\Get(
     *     path="/profile/current-user",
     *     summary="Get Profile Current User",
     *     tags={"PersonalInfo"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Get user info successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message", type="string", example="Get user info successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated - Token is invalid or missing",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="Unauthenticated.")
     *          )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Get user info failed!",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message", type="string", example="Get user info failed!"
     *             )
     *         )
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function getCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(GetCurrentUserCommand::class, GetCurrentUserHandler::class);

        $user = $this->bus->dispatch(new GetCurrentUserCommand());

        return $user ?
            $this->responseSuccess(CurrentUserInfoResource::make($user),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @OA\Post(
     *     path="/profile/update-personal-info",
     *     summary="Update Personal Profile",
     *     description="Update Personal Profile",
     *     tags={"PersonalInfo"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"full_name", "phone_number", "position", "gender_id", "birth_date"},
     *                 @OA\Property(
     *                     property="full_name",
     *                     type="string",
     *                     description="Nhập họ và tên"
     *                 ),
     *                 @OA\Property(
     *                     property="phone_number",
     *                     type="string",
     *                     example="0912345678",
     *                     description="Nhập số điện thoại vào nhé"
     *                 ),
     *                 @OA\Property(
     *                     property="position",
     *                     type="string",
     *                     example="Backend Developer",
     *                     description="Chức vụ"
     *                 ),
     *                  @OA\Property(
     *                      property="gender_id",
     *                      type="integer",
     *                      example="1",
     *                      description="Mã giới tính: 1:male, 2:female, 3:other"
     *                 ),
     *                 @OA\Property(
     *                      property="birth_date",
     *                      type="date",
     *                      example="2000-01-01",
     *                      description="
     *                          Ngày sinh có định dạng YYYY-MM-DD, có thể không cần gửi 0 trước ngày vàng tháng,
     *                          Ví dụ 2000-1-1
     *                      "
     *                 ),
     *                 @OA\Property(
     *                      property="description",
     *                      type="string",
     *                      example="Mô tả chi tiết về bản thân",
     *                      description="Mô tả chi tiết về bản thân"
     *                  ),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Update Profile Successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Saved"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *            response=401,
     *            description="Unauthenticated - Token is invalid or missing",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(property="message", type="string", example="Unauthenticated.")
     *            )
     *     ),
     *     @OA\Response(
     *            response="500",
     *            description="Update Profile Error",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(
     *                    property="message", type="string", example="Save failed"
     *                )
     *            )
     *      ),
     * )
     *
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
     * @OA\Post(
     *     path="/upload-avatar",
     *     summary="Upload Avatar",
     *     description="Upload Avatar",
     *     tags={"PersonalInfo"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="avatar",
     *                     oneOf={
     *                         @OA\Schema(type="string", example="http://localhost/images/default_avatar.jpeg"),
     *                         @OA\Schema(type="null", example=null),
     *                         @OA\Property(
     *                              property="file",
     *                              type="string",
     *                              format="binary",
     *                              description="The file to upload"
     *                          )
     *                     }
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *           response="200",
     *           description="Update Profile Successfully",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="message", type="string", example="Saved"
     *               )
     *           )
     *     ),
     *     @OA\Response(
     *             response=401,
     *             description="Unauthenticated - Token is invalid or missing",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Unauthenticated.")
     *             )
     *      ),
     *     @OA\Response(
     *             response=404,
     *             description="Update Profile Error",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(
     *                     property="message", type="string", example="Save failed"
     *                 )
     *             )
     *      ),
     * )
     *
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
