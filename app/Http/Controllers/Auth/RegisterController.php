<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Resource\UserResourceService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct(
        protected UserResourceService $userResourceService
    ){}

    use RegistersUsers;

    protected string $redirectTo = '/home';

    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data,[
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
        ]);
    }

    protected function create(array $data): Model
    {
        return $this->userResourceService->create(
            array_replace(
                $data,
                ['password' => Hash::make($data['password'])]
            )
        );
    }
}
