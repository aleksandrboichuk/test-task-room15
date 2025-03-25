<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\ApiAuthInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(
        protected ApiAuthInterface $service
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $accessToken = $this->service->login($request->validated());

        if($accessToken){
           return Response::success([
               'accessToken' => $accessToken,
               'expiresIn' => config('jwt.ttl')
           ]);
        }

       return Response::unauthorized('Email or password is incorrect');
    }

    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return Response::success(['message' => 'Logged out successfully']);
    }

    public function refresh(): JsonResponse
    {
        $accessToken = JWTAuth::refresh(JWTAuth::getToken());
        $expiresIn = config('jwt.ttl');

        return Response::success(compact('accessToken', 'expiresIn'));
    }
}
