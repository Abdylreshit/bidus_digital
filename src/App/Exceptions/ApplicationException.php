<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


/**
 *  @OA\Schema(
 *      schema="ErrorResponse",
 *      @OA\Property(
 *          property="success",
 *          type="boolean",
 *          example="false",
 *      ),
 *      @OA\Property(
 *          property="message",
 *          type="string",
 *          description="Error message",
 *      ),
 *      @OA\Property(
 *          property="error",
 *          type="string",
 *          description="ERROR",
 *      ),
 *      @OA\Property(
 *          property="data",
 *          description="error data messages",
 *          type="array",
 *          collectionFormat="multi",
 *          @OA\Items(type="object"),
 *      )
 *  )
 */
class ApplicationException extends Exception
{
    /**
     * @var @string
     */
    public $error;

    /**
     * @var @string
     */
    public $message;

    /**
     * @var @array
     */
    public $data;

    /**
     * @var @int
     */
    public $code;

    public function render() : JsonResponse
    {
        $data = collect();

        if ($this->data){
            foreach ($this->data as $key => $error)
                $data->push([
                    'key' => $key,
                    'message' => Arr::first($error)
                ]);
        }

        return new JsonResponse(
            [
                'success'   => false,
                'error'     => $this->error,
                'message'   => $this->message,
                'data'      => !$data->count() ? [] : $data
            ],
            $this->code,
        );
    }

    /**
     * @param $message
     * @param $attribute
     * @return array|string|string[]
     */
    public function replaceAttribute($message, $attribute)
    {
        return str_replace(
            [':attribute', ':ATTRIBUTE', ':Attribute'],
            [$attribute, Str::upper($attribute), Str::ucfirst($attribute)],
            $message
        );
    }
}
