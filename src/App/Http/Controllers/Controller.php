<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
