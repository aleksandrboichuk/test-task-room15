<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z\s]*$/'
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

    protected function passedValidation(): void
    {
        $this->replace(['password' => Hash::make($this->validated('password'))]);
    }
}
