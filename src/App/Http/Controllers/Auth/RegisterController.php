<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Post(
 *     path="/api/auth/register",
 *     tags={"AUTH"},
 *     summary="User register",
 *     @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
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
 *     )
 * )
 */
class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $access_token = $user->createToken('PAT')->plainTextToken;

        return $this->successResponse([
            'user'          => new UserResource($user),
            'access_token'  => $access_token
        ]);
    }
}
