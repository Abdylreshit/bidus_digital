<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/task/{id}/find",
 *     tags={"TASK"},
 *     summary="Task find",
 *     security={{"bearer": {}}},
 *     @OA\Parameter(
 *        description="task id",
 *        in="path",
 *        name="id",
 *        required=true,
 *        @OA\Schema(type="integer")
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
class FindController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = currentUser();

        $task = $user->tasks()->findOrFail($request->id);

        return $this->successResponse([
            'task' => new TaskResource($task)
        ]);
    }
}
