<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Hash;

class ResetPasswordRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'token' => [
                'required',
                'string',
                'min:60',
                'max:60',
                'regex:/^[a-zA-Z0-9]+$/'
            ],
            'email' => [
                'required',
                'email',
                'regex:/^\S+@\S+\.\S+$/',
                'unique:users'
            ],
            'password' => [
                'required',
                'min:3',
                'confirmed',
                'max:255'
            ],
        ];
    }
}
