<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="StoreRequest",
 *  required={"email", "password"},
 *  @OA\Property(
 *    property="title",
 *    type="string",
 *    description="task title",
 *    example="any"
 *  ),
 *  @OA\Property(
 *     property="description",
 *     type="string",
 *     description="task discription",
 *     example="any"
 *  )
 * )
 */
class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|string',
            'description'   => 'required|string',
        ];
    }
}

