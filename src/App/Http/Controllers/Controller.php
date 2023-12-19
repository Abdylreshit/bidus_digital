<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Exceptions\ApplicationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *          version="v1",
 *          title="TEST API documentation",
 *          description="Swagger doc for test task",
 *          @OA\Contact(
 *              email="acerkezov97@gmail.com"
 *          )
 *      ),
 *      @OA\Server(
 *          description="Test API Server",
 *          url=L5_SWAGGER_CONST_HOST,
 *      ),
 * ),
 * @OA\Schema(
 *     schema="SuccessResponse",
 *     @OA\Property(
 *          property="success",
 *          type="boolean",
 *          example="true",
 *      ),
 *      @OA\Property(
 *          property="data",
 *          description="succes data",
 *          type="array",
 *          collectionFormat="multi",
 *          @OA\Items(type="object")
 *      )
 *  )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function successResponse($data = null, int $status = Response::HTTP_OK, array $headers = [], $options = 0) : JsonResponse
    {
        return new JsonResponse(
            [
                'success' => true,
                'data'    => $data
            ],
            $status,
            $headers,
            $options
        );
    }

    /**
     * @param null $message
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function createdResponse($message = null, int $status = Response::HTTP_CREATED, array $headers = [], $options = 0): JsonResponse
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @return JsonResponse
     */
    public function deletedResponse(): JsonResponse
    {
        return $this->acceptedResponse();
    }

    /**
     * @param null $message
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function acceptedResponse($message = null, int $status = Response::HTTP_ACCEPTED, array $headers = [], $options = 0): JsonResponse
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param int $status
     * @return JsonResponse
     */
    public function noContentResponse(int $status = Response::HTTP_NO_CONTENT): JsonResponse
    {
        return new JsonResponse(null, $status);
    }

    /**
     * @param ApplicationException $exception
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function errorResponse(ApplicationException $exception, array $headers = [], $options = 0): JsonResponse
    {
        return new JsonResponse(
            [
                'success'   => false,
                'error'     => $exception->error,
                'message'   => $exception->message,
                'data'      => $exception->data,
            ],
            $exception->code,
            $headers,
            $options
        );
    }
}
