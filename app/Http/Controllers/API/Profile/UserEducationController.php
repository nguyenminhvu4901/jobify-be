<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserEducation\GetListEducationCurrentUser\GetListEducationCurrentUserCommand;
use App\Commands\UserEducation\GetListEducationCurrentUser\GetListEducationCurrentUserHandle;
use App\Commands\UserEducation\StoreUserEducation\StoreUserEducationCommand;
use App\Commands\UserEducation\StoreUserEducation\StoreUserEducationHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEducation\UserEducationRequest;
use App\Http\Resources\UserCertification\UserCertificationResource;
use App\Http\Resources\UserEducation\CurrentUserEducationResource;
use App\Http\Resources\UserEducation\UserEducationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="User Education",
 *     description="User Education Information and Action",
 * )
 */
class UserEducationController extends Controller
{
    /**
     * @param CommandBusInterface $bus
     */
    public function __construct(
        protected CommandBusInterface $bus
    )
    {}

    /**
     * @OA\Get(
     *     path="/profile/user-education/list-education-current-user",
     *     summary="Get List Education Current User",
     *     tags={"UserEducation"},
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
     * ),
     *
     * @return JsonResponse
     */
    public function getListEducationCurrentUser(): JsonResponse
    {
        $this->bus->addHandler(
            GetListEducationCurrentUserCommand::class,
            GetListEducationCurrentUserHandle::class
        );

        $user = $this->bus->dispatch(new GetListEducationCurrentUserCommand());

        return $user ?
            $this->responseSuccess(new CurrentUserEducationResource($user),
                __('messages.user_get_profile_success')) :
            $this->responseError(__('messages.user_get_profile_error'));
    }

    /**
     * @OA\Post(
     *     path="/profile/user-education/",
     *     summary="Store User Education",
     *     description="Store User Education",
     *     tags={"UserEducation"},
     *     security={{"bearAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "major", "is_studying", "start_date"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="TLU",
     *                     description="Nhập tên trường"
     *                 ),
     *                 @OA\Property(
     *                     property="major",
     *                     type="string",
     *                     example="TLU",
     *                     description="Ngành học"
     *                 ),
     *                 @OA\Property(
     *                      property="is_studying",
     *                      type="boolean",
     *                      example=0,
     *                      description="Đang học ở đây (0: đã tốt nghiệp, 1: chưa tốt nghiệp)"
     *                 ),
     *                 @OA\Property(
     *                       property="start_date",
     *                       type="string",
     *                       format="date",
     *                       example="2025-01-01",
     *                       description="Ngày bắt đầu học"
     *                 ),
     *                 @OA\Property(
     *                      property="end_date",
     *                      type="string",
     *                      format="date",
     *                      example="2025-1-2",
     *                      description="Ngày tốt nghiệp",
     *                 ),
     *                 @OA\Property(
     *                       property="description",
     *                       type="string",
     *                       example="Học cũng vui",
     *                       description="Mô tả thời đi học =)))",
     *                 ),
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *            response="200",
     *            description="Store User Education Successfully",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(
     *                    property="message", type="string", example="Saved"
     *                )
     *            )
     *      ),
     *       @OA\Response(
     *               response=401,
     *               description="Unauthenticated - Token is invalid or missing",
     *               @OA\JsonContent(
     *                   type="object",
     *                   @OA\Property(property="message", type="string", example="Unauthenticated.")
     *               )
     *        ),
     *       @OA\Response(
     *             response="500",
     *             description="Store User Education Fail",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(
     *                     property="message", type="string", example="Fail"
     *                 )
     *             )
     *       ),
     * )
     *
     * @param UserEducationRequest $request
     * @return JsonResponse
     */
    public function store(UserEducationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            StoreUserEducationCommand::class,
            StoreUserEducationHandle::class
        );

        $userEducation = $this->bus->dispatch(StoreUserEducationCommand::withForm($request));

        return $userEducation ?
            $this->responseSuccess(UserEducationResource::make($userEducation),
                __('messages.user_update_profile_success')) :
            $this->responseError(__('messages.user_update_profile_error'));
    }
}
