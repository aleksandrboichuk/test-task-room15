<?php

namespace App\Services\Auth;

use App\Interfaces\LoginInterface;
use Illuminate\Support\Facades\Auth;

class LoginService implements LoginInterface
{
    public function login(array $credentials): bool
    {
       return Auth::attempt($credentials);
    }
}
