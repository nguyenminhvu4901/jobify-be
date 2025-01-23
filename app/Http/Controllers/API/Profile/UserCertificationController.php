<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserCertification\DestroyUserCertification\DestroyUserCertificationCommand;
use App\Commands\UserCertification\DestroyUserCertification\DestroyUserCertificationHandle;
use App\Commands\UserCertification\GetCompleteListOfUserCertification\GetCompleteListOfUserCertificationCommand;
use App\Commands\UserCertification\GetCompleteListOfUserCertification\GetCompleteListOfUserCertificationHandle;
use App\Commands\UserCertification\GetDetailListOfUserCertification\GetDetailListOfUserCertificationCommand;
use App\Commands\UserCertification\GetDetailListOfUserCertification\GetDetailListOfUserCertificationHandle;
use App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug\GetDetailListOfUserCertificationByUserSlugCommand;
use App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug\GetDetailListOfUserCertificationByUserSlugHandle;
use App\Commands\UserCertification\GetListCertificationCurrentUser\GetListCertificationCurrentUserCommand;
use App\Commands\UserCertification\GetListCertificationCurrentUser\GetListCertificationCurrentUserHandle;
use App\Commands\UserCertification\StoreUserCertification\StoreUserCertificationCommand;
use App\Commands\UserCertification\StoreUserCertification\StoreUserCertificationHandle;
use App\Commands\UserCertification\UpdateUserCertification\UpdateUserCertificationCommand;
use App\Commands\UserCertification\UpdateUserCertification\UpdateUserCertificationHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCertification\UserCertificationRequest;
use App\Http\Resources\UserCertification\CurrentUserCertificationResource;
use App\Http\Resources\UserCertification\UserCertificationResource;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="User Certification",
 *     description="User Certification Information and Action",
 * )
 */
class UserCertificationController extends Controller
{
    /**
     * @param CommandBusInterface $bus
     */
    public function __construct(
        protected CommandBusInterface $bus
    )
    {
    }

    /**
     * @OA\Get(
     *     path="/profile/user-certification/list-certification-current-user",
     *     summary="Get List Certification Current User",
     *     tags={"UserCertification"},
     *     security={{"bearAuth": {}}},
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
     *          response=500,
     *          description="Get user info failed!",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Get user info failed!"
     *              )
     *          )
     *      )
     * )
     *
     * @return JsonResponse
     */
    public function getListCertificationCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListCertificationCurrentUserCommand::class,
            GetListCertificationCurrentUserHandle::class
        );

        $user = $this->bus->dispatch(new GetListCertificationCurrentUserCommand());

        return $user ?
            $this->responseSuccess(CurrentUserCertificationResource::make($user),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @OA\Post(
     *     path="/profile/user-certification/",
     *     summary="Store User Certification",
     *     description="Store User Certification",
     *     tags={"UserCertification"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "is_no_expiration", "start_date"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Ielts 8.0",
     *                     description="Nhập tên chứng chỉ"
     *                 ),
     *                 @OA\Property(
     *                     property="organization",
     *                     type="string",
     *                     example="Hội đồng Anh và Em",
     *                     description="Tên tổ chức"
     *                 ),
     *                 @OA\Property(
     *                     property="is_no_expiration",
     *                     type="boolean",
     *                     example=true,
     *                     description="Không có ngày hết hạn (0:false, 1:true), mặc định là 1"
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     type="string",
     *                     format="date",
     *                     example="2025-01-01",
     *                     description="Ngày nhận chứng chỉ"
     *                 ),
     *                 @OA\Property(
     *                     property="end_date",
     *                     type="string",
     *                     format="date",
     *                     example="2025-1-2",
     *                     description="Ngày hết hạn chứng chỉ nếu chứng chỉ không vĩnh viễn",
     *                 ),
     *                 @OA\Property(
     *                      property="attachments",
     *                      type="array",
     *                      description="Mảng chứa file",
     *                      @OA\Items(
     *                          type="object",
     *                          required={"content_type_id"},
     *                          @OA\Property(
     *                              property="title",
     *                              type="string",
     *                              example="File chứng chỉ",
     *                              description="Tiêu đề file đính kèm"
     *                          ),
     *                          @OA\Property(
     *                              property="description",
     *                              type="string",
     *                              example="File scan chứng chỉ IELTS",
     *                              description="Mô tả file đính kèm"
     *                          ),
     *                         @OA\Property(
     *                               property="content_type_id",
     *                               type="integer",
     *                               example="1",
     *                               description="ID loại nội dung của file (tham chiếu tới bảng default_content_types), Loại nội dung: 1 (image), 2 (file), 3 (url), 4 (video)"
     *                         ),
     *                         @OA\Property(
     *                                property="url",
     *                                type="string",
     *                                example="http://localhost:8040/api/documentation",
     *                                description="ID loại nội dung của file (tham chiếu tới bảng default_content_types), Loại nội dung: 1 (image), 2 (file), 3 (url), 4 (video)"
     *                          ),
     *                          @OA\Property(
     *                                property="image",
     *                                type="string",
     *                                format="binary",
     *                                description="The file to upload"
     *                          ),
     *                          @OA\Property(
     *                                 property="video",
     *                                 type="string",
     *                                 format="binary",
     *                                 description="The file to upload"
     *                          ),
     *                      )
     *                 ),
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *           response="200",
     *           description="Store User Certification Successfully",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="message", type="string", example="Saved"
     *               )
     *           )
     *     ),
     *      @OA\Response(
     *              response=401,
     *              description="Unauthenticated - Token is invalid or missing",
     *              @OA\JsonContent(
     *                  type="object",
     *                  @OA\Property(property="message", type="string", example="Unauthenticated.")
     *              )
     *       ),
     *      @OA\Response(
     *            response="500",
     *            description="Store User Certification Fail",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(
     *                    property="message", type="string", example="Fail"
     *                )
     *            )
     *      ),
     * )
     *
     * @param UserCertificationRequest $request
     * @return JsonResponse
     */
    public function store(UserCertificationRequest $request): JsonResponse
    {
        $this->bus->addHandler(StoreUserCertificationCommand::class, StoreUserCertificationHandle::class);

        $userCertification = $this->bus->dispatch(StoreUserCertificationCommand::withForm($request));

        return $userCertification ?
            $this->responseSuccess(UserCertificationResource::make($userCertification),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }

    /**
     *
     *
     * @return JsonResponse
     */
    public function getCompleteListOfUserCertification(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserCertificationCommand::class,
            GetCompleteListOfUserCertificationHandle::class
        );

        $userCertifications = $this->bus->dispatch(new GetCompleteListOfUserCertificationCommand());

        return $userCertifications ?
            $this->responseSuccess(UserCertificationResource::collection($userCertifications),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @param UserCertificationRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserCertification(UserCertificationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserCertificationCommand::class,
            GetDetailListOfUserCertificationHandle::class
        );

        $userCertification = $this->bus->dispatch(GetDetailListOfUserCertificationCommand::withForm($request));

        return $userCertification ?
            $this->responseSuccess(UserCertificationResource::make($userCertification),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @param UserCertificationRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserCertificationByUserSlug(UserCertificationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserCertificationByUserSlugCommand::class,
            GetDetailListOfUserCertificationByUserSlugHandle::class
        );

        $userCertification = $this->bus->dispatch(GetDetailListOfUserCertificationByUserSlugCommand::withForm($request));

        return $userCertification ?
            $this->responseSuccess(UserCertificationResource::collection($userCertification),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @param UserCertificationRequest $request
     * @return JsonResponse
     */
    public function update(UserCertificationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserCertificationCommand::class,
            UpdateUserCertificationHandle::class
        );

        $userCertification = $this->bus->dispatch(UpdateUserCertificationCommand::withForm($request));

        return $userCertification ?
            $this->responseSuccess(UserCertificationResource::make($userCertification),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }

    /**
     * @param UserCertificationRequest $request
     * @return JsonResponse
     */
    public function destroy(UserCertificationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
          DestroyUserCertificationCommand::class,
          DestroyUserCertificationHandle::class
        );

        $userCertification = $this->bus->dispatch(DestroyUserCertificationCommand::withForm($request));

        return $userCertification ?
            $this->responseSuccessWithNoData(__('messages.user_destroy_profile_success')) :
            $this->responseError(__('messages.user_destroy_profile_error'));
    }
}
