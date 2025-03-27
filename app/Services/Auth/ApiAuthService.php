<?php

namespace App\Services\Auth;

use App\Interfaces\ApiAuthInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthService implements ApiAuthInterface
{
    public function login(array $credentials): string|false
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return false;
        }

        return $token;
    }

    public function refresh(): string
    {
        return JWTAuth::refresh(JWTAuth::getToken());
    }

    public function logout(): bool
    {
        return JWTAuth::invalidate(JWTAuth::getToken());
    }
}
