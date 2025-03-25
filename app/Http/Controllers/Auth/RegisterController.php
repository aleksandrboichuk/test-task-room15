<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
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
        return Validator::make($data, RegisterRequest::rules());
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
