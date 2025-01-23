<?php

namespace App\Http\Controllers\API\Profile;

use App\Commands\UserEducation\GetListEducationCurrentUser\GetListEducationCurrentUserCommand;
use App\Commands\UserEducation\GetListEducationCurrentUser\GetListEducationCurrentUserHandle;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserEducation\CurrentUserEducationResource;
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
}
