<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="LoginRequest",
 *  required={"email", "password"},
 *  @OA\Property(
 *    property="email",
 *    type="string",
 *    description="user email",
 *    example="any@any.com"
 *  ),
 *  @OA\Property(
 *    property="password",
 *    type="string",
 *    description="user password",
 *    example="123123"
 *  )
 * )
 */
class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|string|min:6|max:30',
        ];
    }
}

