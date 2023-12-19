<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *  schema="RegisterRequest",
 *  required={"email", "password", "password_confirmation"},
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
 *  ),
 *  @OA\Property(
 *     property="password_confirmation",
 *     type="string",
 *     description="user password confirmation",
 *     example="123123"
 *   )
 * )
 */
class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|max:30|confirmed',
            'password_confirmation' => 'required|min:6|max:30'
        ];
    }
}
