<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\PersonalInfo\GetInformationCurrentUser\GetCurrentUserCommand;
use App\Commands\PersonalInfo\GetInformationCurrentUser\GetCurrentUserHandler;
use App\Commands\PersonalInfo\GetInformationCVCurrentUser\GetInformationCVCurrentUserCommand;
use App\Commands\PersonalInfo\GetInformationCVCurrentUser\GetInformationCVCurrentUserHandler;
use App\Commands\PersonalInfo\UpdateProfile\UpdateProfileCommand;
use App\Commands\PersonalInfo\UpdateProfile\UpdateProfileHandler;
use App\Commands\PersonalInfo\UploadAvatar\UploadAvatarCommand;
use App\Commands\PersonalInfo\UploadAvatar\UploadAvatarHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateUserProfileAvatarRequest;
use App\Http\Requests\Profile\UpdateUserProfileRequest;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Personal Info",
 *     description="Information And Profile Changes"
 * )
 */
class PersonalInfoController extends Controller
{
    public function __construct(
        protected CommandBusInterface $bus
    )
    {}

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
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *           response=401,
     *           description="The user is not logged in",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="message", type="string", example="The user is not logged in"),
     *               @OA\Property(property="status_code", type="integer", example=401)
     *           )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Get user info failed!",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message", type="string", example="Get user info failed!"
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=500)
     *         )
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function getInformationCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(GetCurrentUserCommand::class, GetCurrentUserHandler::class);

        $result = $this->bus->dispatch(new GetCurrentUserCommand());

        if(!empty($result['data'])){
           return $this->responseSuccess(
               data: $result['data'],
               message: $result['message'],
               cache: $result['cache'] ?? null
           );
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @return JsonResponse
     */
    public function getInformationCVCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetInformationCVCurrentUserCommand::class,
            GetInformationCVCurrentUserHandler::class
        );

        $result = $this->bus->dispatch(new GetInformationCVCurrentUserCommand());

        if(!empty($result['data'])){

            return $this->responseSuccess(
                data: $result['data'],
                message: $result['message'],
                cache: $result['cache'] ?? null
            );
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
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
     *                     example="Nguyễn Văn A",
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
     *              ),
     *              @OA\Property(property="status_code", type="integer", example=200)
     *          )
     *     ),
     *     @OA\Response(
     *           response=401,
     *           description="The user is not logged in",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="message", type="string", example="The user is not logged in"),
     *               @OA\Property(property="status_code", type="integer", example=401)
     *           )
     *     ),
     *     @OA\Response(
     *            response="500",
     *            description="Update Profile Error",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(
     *                    property="message", type="string", example="Save failed"
     *                ),
     *                @OA\Property(property="status_code", type="integer", example=500)
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

        $result = $this->bus->dispatch(UpdateProfileCommand::withForm($request));

        if(!empty($result['user'])){
            return $this->responseSuccess(data: $result['user'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }

    /**
     * @OA\Post(
     *     path="/profile/upload-avatar",
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
     *                     type="string",
     *                     format="binary",
     *                     description="The file to upload"
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
     *               ),
     *               @OA\Property(property="status_code", type="integer", example=200)
     *           )
     *     ),
     *     @OA\Response(
     *           response=401,
     *           description="The user is not logged in",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="message", type="string", example="The user is not logged in"),
     *               @OA\Property(property="status_code", type="integer", example=401)
     *           )
     *     ),
     *     @OA\Response(
     *             response=500,
     *             description="Update Profile Error",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(
     *                     property="message", type="string", example="Save failed"
     *                 ),
     *                 @OA\Property(property="status_code", type="integer", example=500)
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

        $result = $this->bus->dispatch(UploadAvatarCommand::withForm($request));

        if(!empty($result['user'])){
            return $this->responseSuccess(data: $result['user'], message: $result['message']);
        }

        return $this->responseError(
            message: $result['message'],
            error: $result['error'] ?? null,
            statusCode: $result['status_code'] ?? null
        );
    }
}
