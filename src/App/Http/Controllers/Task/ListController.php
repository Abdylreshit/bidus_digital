<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/task/list",
 *     tags={"TASK"},
 *     summary="User task list",
 *     security={{"bearer": {}}},
 *     @OA\Parameter(
 *        description="order by",
 *        in="query",
 *        name="order_by",
 *        @OA\Schema(
 *          default="id",
 *          type="string",
 *          enum={
 *              "id",
 *              "title",
 *              "description",
 *              "completed_at",
 *              "completed_time"
 *          },
 *        ),
 *     ),
 *     @OA\Parameter(
 *         description="order by type",
 *         in="query",
 *         name="order_by_type",
 *         @OA\Schema(
 *           default="id",
 *           type="string",
 *           enum={
 *               "asc",
 *               "desc"
 *           },
 *         ),
 *     ),
 *     @OA\Parameter(
 *           description="search value",
 *           in="query",
 *           name="search",
 *           @OA\Schema(type="string"),
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
class ListController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = currentUser();

        $tasks = $user->tasks()
            ->when($request->order_by != null, fn($q)=>$q->orderBy($request->order_by, $request->order_by_type))
            ->when($request->search != null, fn($q)=>$q->where('title', 'LIKE', "%{$request->search}%")->orWhere('description', 'LIKE', "%{$request->search}%"))
            ->paginate(10);

        return $this->successResponse([
            'tasks' => new PaginationResource($tasks, TaskResource::collection($tasks))
        ]);
    }
}
