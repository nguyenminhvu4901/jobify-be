<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserEducation\DestroyUserEducation\DestroyUserEducationCommand;
use App\Commands\UserEducation\DestroyUserEducation\DestroyUserEducationHandle;
use App\Commands\UserEducation\GetCompleteListOfUserEducation\GetCompleteListOfUserEducationCommand;
use App\Commands\UserEducation\GetCompleteListOfUserEducation\GetCompleteListOfUserEducationHandle;
use App\Commands\UserEducation\GetDetailListOfUserEducation\GetDetailListOfUserEducationCommand;
use App\Commands\UserEducation\GetDetailListOfUserEducation\GetDetailListOfUserEducationHandle;
use App\Commands\UserEducation\GetDetailListOfUserEducationByUserSlug\GetDetailListOfUserEducationByUserSlugCommand;
use App\Commands\UserEducation\GetDetailListOfUserEducationByUserSlug\GetDetailListOfUserEducationByUserSlugHandle;
use App\Commands\UserEducation\GetListEducationCurrentUser\GetListEducationCurrentUserCommand;
use App\Commands\UserEducation\GetListEducationCurrentUser\GetListEducationCurrentUserHandle;
use App\Commands\UserEducation\StoreUserEducation\StoreUserEducationCommand;
use App\Commands\UserEducation\StoreUserEducation\StoreUserEducationHandle;
use App\Commands\UserEducation\UpdateUserEducation\UpdateUserEducationCommand;
use App\Commands\UserEducation\UpdateUserEducation\UpdateUserEducationHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEducation\UserEducationRequest;
use App\Http\Resources\UserEducation\CurrentUserEducationResource;
use App\Http\Resources\UserEducation\UserEducationResource;
use Illuminate\Http\JsonResponse;
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
     *     tags={"User Education"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Get user info successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message", type="string", example="Get user info successfully"
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=200),
     *             @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/CurrentUserEducationResource")
     *             ),
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
     *          response=500,
     *          description="Get user info failed!",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Get user info failed!"
     *              ),
     *              @OA\Property(property="status_code", type="integer", example=500)
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

        $result = $this->bus->dispatch(new GetListEducationCurrentUserCommand());

        if(!empty($result['user'])){
            return $this->responseSuccess(new CurrentUserEducationResource($result['user']), $result['message']);
        }

        return  $this->responseError($result['message']);
    }

    /**
     * @OA\Post(
     *     path="/profile/user-education/",
     *     summary="Store User Education",
     *     description="Store User Education",
     *     tags={"User Education"},
     *     security={{"bearerAuth": {}}},
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
     *                ),
     *                @OA\Property(property="status_code", type="integer", example=200)
     *            )
     *      ),
     *     @OA\Response(
     *           response=401,
     *           description="The user is not logged in",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="message", type="string", example="The user is not logged in"),
     *               @OA\Property(property="status_code", type="integer", example=401)
     *           )
     *     ),
     *       @OA\Response(
     *             response="500",
     *             description="Store User Education Fail",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(
     *                     property="message", type="string", example="Fail"
     *                 ),
     *                 @OA\Property(property="status_code", type="integer", example=500)
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

        $result = $this->bus->dispatch(StoreUserEducationCommand::withForm($request));

        if(!empty($result['userEducation'])){
            return $this->responseSuccess(UserEducationResource::make($result['userEducation']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    /**
     * @OA\Get(
     *     path="/profile/user-education/complete-list-user-education",
     *     summary="Get Complete List User Education",
     *     tags={"UserEducation"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response="200",
     *         description="Get user info successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message", type="string", example="Get user info successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated - Token is invalid or missing",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthenticated."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Get user info failed!",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Get user info failed!"
     *             )
     *         )
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function getCompleteListOfUserEducation(): JsonResponse
    {
        $this->bus->addHandler(
            GetCompleteListOfUserEducationCommand::class,
            GetCompleteListOfUserEducationHandle::class
        );

        $result = $this->bus->dispatch(new GetCompleteListOfUserEducationCommand());

        if(!empty($result['userEducation'])){
            return $this->responseSuccess(
                UserEducationResource::collection($result['userEducation']), $result['message']
            );
        }

        return $this->responseError($result['message']);
    }

    /**
     * @OA\Get(
     *      path="/profile/user-education/detail-list-user-education",
     *      summary="Get Detail List User Education",
     *      tags={"UserEducation"},
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *         name="user_education_id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="Thông tin Id của User Education",
     *         example=1
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Get user info successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Get user info successfully"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthenticated - Token is invalid or missing",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated."
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="Get user info failed!",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Get user info failed!"
     *              )
     *          )
     *      )
     * )
     *
     * @param UserEducationRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserEducation(UserEducationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserEducationCommand::class,
            GetDetailListOfUserEducationHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserEducationCommand::withForm($request));

        if(!empty($result['userEducation'])){
            return $this->responseSuccess(
                UserEducationResource::make($result['userEducation']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    /**
     * @OA\Get(
     *      path="/profile/user-education/detail-list-user-education-by-user-slug",
     *      summary="Get Detail List User Education By User Slug",
     *      tags={"UserEducation"},
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *         name="user_slug",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Thông tin Slug của User",
     *         example="user-admin"
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Get user info successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Get user info successfully"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthenticated - Token is invalid or missing",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated."
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="Get user info failed!",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Get user info failed!"
     *              )
     *          )
     *      )
     * )
     *
     * @param UserEducationRequest $request
     * @return JsonResponse
     */
    public function getDetailListOfUserEducationByUserSlug(UserEducationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            GetDetailListOfUserEducationByUserSlugCommand::class,
            GetDetailListOfUserEducationByUserSlugHandle::class
        );

        $result = $this->bus->dispatch(GetDetailListOfUserEducationByUserSlugCommand::withForm($request));

        if(!empty($result['userEducation'])){
            return $this->responseSuccess(UserEducationResource::collection($result['userEducation']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    /**
     * @OA\Put(
     *     path="/profile/user-education/",
     *     summary="Update User Education",
     *     description="Update User Education",
     *     tags={"User Education"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"user_education_id", "name", "major", "is_studying", "start_date"},
     *                 @OA\Property(
     *                      property="user_education_id",
     *                      type="integer",
     *                      example=1,
     *                      description="Nhập id của user education"
     *                  ),
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
     *     @OA\Response(
     *             response="200",
     *             description="Update User Education Successfully",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(
     *                     property="message", type="string", example="Saved"
     *                 ),
     *                 @OA\Property(property="status_code", type="integer", example=200)
     *             )
     *      ),
     *     @OA\Response(
     *            response=401,
     *            description="The user is not logged in",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(property="message", type="string", example="The user is not logged in"),
     *                @OA\Property(property="status_code", type="integer", example=401)
     *            )
     *      ),
     *      @OA\Response(
     *              response="500",
     *              description="Update User Education Fail",
     *              @OA\JsonContent(
     *                  type="object",
     *                  @OA\Property(
     *                      property="message", type="string", example="Fail"
     *                  ),
     *                  @OA\Property(property="status_code", type="integer", example=500)
     *              )
     *       ),
     * )
     *
     * @param UserEducationRequest $request
     * @return JsonResponse
     */
    public function update(UserEducationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            UpdateUserEducationCommand::class,
            UpdateUserEducationHandle::class
        );

        $result = $this->bus->dispatch(UpdateUserEducationCommand::withForm($request));

        if(!empty($result['userEducation'])){
            return $this->responseSuccess(
                UserEducationResource::make($result['userEducation']), $result['message']);
        }

        return $this->responseError($result['message']);
    }

    /**
     * @OA\Delete(
     *     path="/profile/user-education/",
     *     summary="Destroy User Education",
     *     description="Destroy User Education",
     *     tags={"User Education"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"user_education_id", "user_slug"},
     *                 @OA\Property(
     *                     property="user_education_id",
     *                     type="integer",
     *                     example="1,
     *                     description="Nhập id của user education"
     *                 ),
     *                 @OA\Property(
     *                     property="user_slug",
     *                     type="string",
     *                     example="user-admin",
     *                     description="Nhập slug của tài khoản đang đăng nhập hiện tại"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *              response="200",
     *              description="Destroy User Education Successfully",
     *              @OA\JsonContent(
     *                  type="object",
     *                  @OA\Property(
     *                      property="message", type="string", example="Saved"
     *                  ),
     *                  @OA\Property(property="status_code", type="integer", example=200)
     *              )
     *      ),
     *     @OA\Response(
     *             response=401,
     *             description="The user is not logged in",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="The user is not logged in"),
     *                 @OA\Property(property="status_code", type="integer", example=401)
     *             )
     *       ),
     *      @OA\Response(
     *               response="500",
     *               description="Destroy User Education Fail",
     *               @OA\JsonContent(
     *                   type="object",
     *                   @OA\Property(
     *                       property="message", type="string", example="Fail"
     *                   ),
     *                   @OA\Property(property="status_code", type="integer", example=500)
     *               )
     *       ),
     * )
     *
     * @param UserEducationRequest $request
     * @return JsonResponse
     */
    public function destroy(UserEducationRequest $request): JsonResponse
    {
        $this->bus->addHandler(
            DestroyUserEducationCommand::class,
            DestroyUserEducationHandle::class
        );

        $result = $this->bus->dispatch(DestroyUserEducationCommand::withForm($request));

        if(!empty($result['userEducation'])){
            return $this->responseSuccessWithNoData($result['message']);
        }

        return $this->responseError($result['message'], $result['status_code']);
    }
}
