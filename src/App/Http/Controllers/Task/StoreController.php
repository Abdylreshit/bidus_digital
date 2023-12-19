<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/task/store",
 *     tags={"TASK"},
 *     summary="Task create",
 *     security={{"bearer": {}}},
 *     @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/StoreRequest")
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
class StoreController extends Controller
{
    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $user = currentUser();

        $task = $user->tasks()
            ->create([
                'title'         => $request->title,
                'description'   => $request->description,
                'completed_at'  => false
            ]);

        return $this->successResponse([
            'task' => new TaskResource($task)
        ]);
    }
}
