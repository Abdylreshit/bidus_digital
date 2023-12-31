<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/task/{id}/update",
 *     tags={"TASK"},
 *     summary="Task update",
 *     security={{"bearer": {}}},
 *     @OA\Parameter(
 *        description="task id",
 *        in="path",
 *        name="id",
 *        required=true,
 *        @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/UpdateRequest")
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
class UpdateController extends Controller
{
    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request): JsonResponse
    {
        $user = currentUser();

        $task = $user->tasks()
            ->findOrFail($request->id);

        $task->update([
            'title'         => $request->title,
            'description'   => $request->description,
        ]);

        return $this->successResponse([
            'task' => new TaskResource($task)
        ]);
    }
}
