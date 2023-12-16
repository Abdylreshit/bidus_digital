<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/auth/me",
 *     tags={"AUTH"},
 *     summary="User Me",
 *     security={{"bearer": {}}},
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
class MeController extends Controller
{

}
