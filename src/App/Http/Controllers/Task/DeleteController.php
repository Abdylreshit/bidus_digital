<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/task/{id}/delete",
 *     tags={"TASK"},
 *     summary="Task delete",
 *     security={{"bearer": {}}},
 *     @OA\Parameter(
 *        description="task id",
 *        in="path",
 *        name="id",
 *        required=true,
 *        @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *          response="202",
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
class DeleteController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = currentUser();

        $task = $user->tasks()->findOrFail($request->id);

        $task->delete();

        return $this->acceptedResponse('ok');
    }
}
