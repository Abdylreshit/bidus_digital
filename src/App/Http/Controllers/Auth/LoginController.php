<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Throwable;

/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     tags={"AUTH"},
 *     summary="User login",
 *     @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 *     ),
 *     @OA\Response(
 *          response="200",
 *          description="result",
 *          @OA\JsonContent(ref="#/components/schemas/SuccessResponse"),
 *     ),
 *     @OA\Response(
 *          response="500",
 *          description="result",
 *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse"),
 *      )
 * )
 */
class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = User::query()
            ->whereEmail($request->email)
            ->firstOrFail();

        throw_if(!Hash::check($request->password, $user->password), ModelNotFoundException::class);

        $access_token = $user->createToken('PAT')->plainTextToken;

        return $this->successResponse([
            'user'          => new UserResource($user),
            'access_token'  => $access_token
        ]);
    }
}
