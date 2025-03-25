<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'regex:/^\S+@\S+\.\S+$/'
            ],
            'password' => [
                'required',
                'min:8'
            ],
        ];
    }
}
