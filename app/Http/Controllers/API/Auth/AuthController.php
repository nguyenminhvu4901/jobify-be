<?php

namespace App\Http\Controllers\API\Auth;

use App\Commands\Auth\JobSeekerRegister\JobSeekerRegisterCommand;
use App\Commands\Auth\JobSeekerRegister\JobSeekerRegisterHandler;
use App\Commands\Auth\LoginStandard\LoginStandardCommand;
use App\Commands\Auth\LoginStandard\LoginStandardHandler;
use App\Commands\Auth\Logout\LogoutCommand;
use App\Commands\Auth\Logout\LogoutHandler;
use App\Commands\Auth\RecruiterRegister\RecruiterCommand;
use App\Commands\Auth\RecruiterRegister\RecruiterHandler;
use App\Commands\Auth\ResetPassword\ResetPasswordCommand;
use App\Commands\Auth\ResetPassword\ResetPasswordHandler;
use App\Commands\Auth\SendForgotPassword\SendForgotPasswordCommand;
use App\Commands\Auth\SendForgotPassword\SendForgotPasswordHandler;
use App\Commands\Auth\UserChangePassword\UserChangePasswordCommand;
use App\Commands\Auth\UserChangePassword\UserChangePasswordHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\JobSeekerRegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RecruiterRegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UserChangePassword;
use App\Http\Resources\Auth\JobSeekerRegisterResource;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RecruiterRegisterResource;
use App\Http\Resources\Auth\UserChangePasswordResource;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Auth Resource"
 * )
 */
class AuthController extends Controller
{
    /**
     * @param CommandBusInterface $bus
     */
    public function __construct(
        protected CommandBusInterface $bus)
    {
    }

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="Process login user",
     *     description="Authenticate a user and return a JWT token if successful.",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"email", "password"},
     *                 @OA\Property(property="email", type="string", example="admin@example.com"),
     *                 @OA\Property(property="password", type="string", example="Admin@12"),
     *                 @OA\Property(property="remember", type="boolean", example=true)
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="User login successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User login successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User login failure",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User login failure")
     *         )
     *     )
     * )
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $this->bus->addHandler(LoginStandardCommand::class, LoginStandardHandler::class);

        $user = $this->bus->dispatch(LoginStandardCommand::withForm($request));

        return $user ?
            $this->responseSuccess(LoginResource::make($user), __('messages.user_login_success')) :
            $this->responseUnauthorized(__('messages.user_login_error'));
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     summary="Logout user",
     *     description="Log out a user by invalidating the JWT token.",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Người dùng đã đăng xuất")
     *         )
     *     ),
     *     @OA\Response(
     *           response=401,
     *           description="Unauthenticated - Token is invalid or missing",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="message", type="string", example="Unauthenticated.")
     *           )
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Server Error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Server Error"
     *              )
     *          )
     *     )
     * )
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->bus->addHandler(LogoutCommand::class, LogoutHandler::class);

        $result = $this->bus->dispatch(new LogoutCommand(request()->bearerToken()));

        return $result ?
            $this->responseSuccessWithNoData(__('messages.user_is_logged_out')) :
            $this->responseInternalServerError();
    }


    /**
     * @OA\Post(
     *     path="/auth/job-seeker-register",
     *     operationId="resigterJobSeeker",
     *     summary="Create new JobSeeker Account",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"full_name", "email", "password", "password_confirmation", "phone_number"},
     *                  @OA\Property(
     *                      property="full_name",
     *                      type="string",
     *                      example="Người tìm việc 1",
     *                      description="Họ tên người tìm việc"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      example="jobseeker123@gmail.com",
     *                      description="Email người tìm việc"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      example="Timviec@123",
     *                      description="Mật khẩu"
     *                  ),
     *                  @OA\Property(
     *                      property="password_confirmation",
     *                      type="string",
     *                      example="Timviec@123",
     *                      description="Nhập lại mật khẩu"
     *                  ),
     *                  @OA\Property(
     *                      property="phone_number",
     *                      type="string",
     *                      example="0912345678",
     *                      description="Nhập số điện thoại vào nhé"
     *                  )
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="JobSeeker Register Successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message", type="string", example="Registration successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="500",
     *          description="JobSeeker Register Error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Registration error"
     *              )
     *          )
     *      ),
     * )
     *
     * @param JobSeekerRegisterRequest $request
     * @return JsonResponse
     */
    public function jobSeekerRegister(JobSeekerRegisterRequest $request): JsonResponse
    {
        $this->bus->addHandler(JobSeekerRegisterCommand::class, JobSeekerRegisterHandler::class);

        $jobSeeker = $this->bus->dispatch(JobSeekerRegisterCommand::withForm($request));

        return $jobSeeker ?
            $this->responseSuccess(JobSeekerRegisterResource::make($jobSeeker),
                __('messages.user_register_success')) :
            $this->responseError(__('messages.user_register_error'));
    }

    /**
     * @OA\Post(
     *     path="/auth/recruiter-register",
     *     operationId="registerRecruiter",
     *     summary="Create new Recruiter Account",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={
     *                      "full_name", "email", "password", "password_confirmation", "phone_number",
     *                      "gender_id", "company_name", "company_scale_id", "tax_code", "province", "district"
     *                  },
     *                  @OA\Property(
     *                      property="full_name",
     *                      type="string",
     *                      example="Người tìm việc 1",
     *                      description="Họ tên người tìm việc"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      example="jobseeker.deptrai.123@gmail.com",
     *                      description="Email người tìm việc"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      example="Timviec@123",
     *                      description="Mật khẩu"
     *                  ),
     *                  @OA\Property(
     *                      property="password_confirmation",
     *                      type="string",
     *                      example="Timviec@123",
     *                      description="Nhập lại mật khẩu"
     *                  ),
     *                  @OA\Property(
     *                      property="phone_number",
     *                      type="string",
     *                      example="0912345678",
     *                      description="Nhập số điện thoại vào nhé"
     *                  ),
     *                  @OA\Property(
     *                       property="gender_id",
     *                       type="integer",
     *                       example="1",
     *                       description="Mã giới tính: 1:male, 2:female, 3:other"
     *                  ),
     *                  @OA\Property(
     *                        property="company_name",
     *                        type="string",
     *                        example="Công ty trách nhiệm hữu hạn siêu đẹp trai",
     *                        description="Tên công ty"
     *                   ),
     *                   @OA\Property(
     *                         property="company_scale_id",
     *                         type="integer",
     *                         example=2,
     *                         description="Mã Id của bảng company_scales, quy mô công ty"
     *                    ),
     *                    @OA\Property(
     *                         property="tax_code",
     *                         type="string",
     *                         example="A0011",
     *                         description="Mã số thuế của công ty"
     *                    ),
     *                   @OA\Property(
     *                         property="province",
     *                         type="integer",
     *                         example="1",
     *                         description="Mã Id của Tỉnh/Thành phố"
     *                   ),
     *                   @OA\Property(
     *                          property="district",
     *                          type="integer",
     *                          example="1",
     *                          description="Mã Id của Quận/Huyện"
     *                   ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Recruiter Register Successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Registration successfully"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *           response="500",
     *           description="Recruiter Register Error",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="message", type="string", example="Registration error"
     *               )
     *           )
     *       ),
     * )
     *
     * @param RecruiterRegisterRequest $request
     * @return JsonResponse
     */
    public function recruiterRegister(RecruiterRegisterRequest $request): JsonResponse
    {
        $this->bus->addHandler(RecruiterCommand::class, RecruiterHandler::class);

        $recruiter = $this->bus->dispatch(RecruiterCommand::withForm($request));

        return $recruiter ?
            $this->responseSuccess(RecruiterRegisterResource::make($recruiter), __('messages.user_register_success')) :
            $this->responseError(__('messages.user_register_error'));
    }

    /**
     * @OA\Patch(
     *     path="/auth/change-password",
     *     operationId="changePassword",
     *     summary="Change Password Account",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={
     *                     "slug", "email", "current_password", "new_password", "new_password_confirmation"
     *                 },
     *                  @OA\Property(
     *                      property="slug",
     *                      type="string",
     *                      example="user-admin",
     *                      description="Slug của Account"
     *                  ),
     *                  @OA\Property(
     *                       property="email",
     *                       type="string",
     *                       example="admin@example.com",
     *                       description="Email của Account"
     *                  ),
     *                  @OA\Property(
     *                       property="current_password",
     *                       type="string",
     *                       example="Admin@12",
     *                       description="Password cũ của Account"
     *                  ),
     *                  @OA\Property(
     *                       property="new_password",
     *                       type="string",
     *                       example="Admin@123",
     *                       description="Password mới của Account"
     *                  ),
     *                  @OA\Property(
     *                       property="new_password_confirmation",
     *                       type="string",
     *                       example="Admin@123",
     *                       description="Nhập lại Password mới của Account"
     *                  ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *           response="200",
     *           description="Change Password Successfully",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="message", type="string", example="User change password successfully"
     *               )
     *           )
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
     *            description="Change Password Fail",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(
     *                    property="message", type="string", example="User Change password Fail!"
     *                )
     *            )
     *      ),
     * )
     *
     * @param UserChangePassword $request
     * @return JsonResponse
     */
    public function changePassword(UserChangePassword $request): JsonResponse
    {
        $this->bus->addHandler(UserChangePasswordCommand::class, UserChangePasswordHandler::class);

        $user = $this->bus->dispatch(UserChangePasswordCommand::withForm($request));

        return $user ?
            $this->responseSuccess(UserChangePasswordResource::make($user), __('messages.user_change_password_success')) :
            $this->responseError(__('messages.user_change_password_error'));
    }

    /**
     * @OA\Post(
     *     path="/forgot-password",
     *     operationId="forgotPassword",
     *     summary="Send Mail To Get New Password",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"email"},
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      example="admin@example.com"
     *                  ),
     *              )
     *         )
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *         description="Send Email Successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Send Password Successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Send Email Fail",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Send Email Fail")
     *         )
     *     )
     * )
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function sendForgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $this->bus->addHandler(SendForgotPasswordCommand::class, SendForgotPasswordHandler::class);

        $data = $this->bus->dispatch(SendForgotPasswordCommand::withForm($request));

        return $data ?
            $this->responseSuccess("", $data) :
            $this->responseError();
    }

    /**
     * @OA\Post(
     *     path="/reset-password",
     *     summary="Reset Password",
     *     description="Reset Password",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"token", "email", "password", "password_confirmation"},
     *                 @OA\Property(
     *                     property="token",
     *                     type="string",
     *                     description="Send mail đi rồi lấy token đấy đặt vào đây",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="admin@example.com"
     *                 ),
     *                 @OA\Property(
     *                       property="password",
     *                       type="string",
     *                       example="Timviec@123",
     *                       description="Mật khẩu"
     *                  ),
     *                 @OA\Property(
     *                       property="password_confirmation",
     *                       type="string",
     *                       example="Timviec@123",
     *                       description="Nhập lại mật khẩu"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Reset Password Successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message", type="string", example="Reset Password successfully"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Reset Password Fail",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Reset Password Fail")
     *         )
     *     )
     * )
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $this->bus->addHandler(ResetPasswordCommand::class, ResetPasswordHandler::class);

        $data = $this->bus->dispatch(ResetPasswordCommand::withForm($request));

        return $data ?
            $this->responseSuccess("", $data) :
            $this->responseError();
    }

    /**
     * @return JsonResponse
     */
    public function unauthorized(): JsonResponse
    {
        return $this->responseUnauthorized();
    }
}
