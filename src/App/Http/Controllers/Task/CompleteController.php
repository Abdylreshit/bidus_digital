<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/task/{id}/complete",
 *     tags={"TASK"},
 *     summary="Task complete",
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
class CompleteController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = currentUser();

        $task = $user->tasks()
            ->findOrFail($request->id);

        $task->update([
            'completed_at'  => true,
            'completed_time' => now()
        ]);

        return $this->successResponse([
            'task' => new TaskResource($task)
        ]);
    }
}
