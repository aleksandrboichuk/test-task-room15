<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = '/home';

    protected function validateLogin(Request $request): void
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^\S+@\S+\.\S+$/',
            ],
            'password' => [
                'required',
            ],
        ]);
    }
}
