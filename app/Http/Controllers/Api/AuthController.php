<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\LoginInterface;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected LoginInterface $service
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
       if($token = $this->service->loginViaAPI($request->validated())){
           return Response::success([
               'token' => $token,
               'expires_in' => config('jwt.ttl')
           ]);
       }

       return Response::unauthorized('Email or password is incorrect');
    }

    public function logout()
    {
        JWTAut::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());
        return response()->json(compact('token'));
    }
}
