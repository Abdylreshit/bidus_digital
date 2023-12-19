<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="UpdateRequest",
 *  required={"title", "description", "completed_at"},
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
class UpdateRequest extends FormRequest
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

