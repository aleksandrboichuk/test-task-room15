<?php

namespace App\Services\Auth;

use App\Interfaces\RegisterInterface;
use App\Services\Resource\UserResourceService;
use Illuminate\Support\Facades\Auth;

class RegisterService implements RegisterInterface
{

    public function __construct(
        protected UserResourceService $userResourceService
    ){}

    public function register(array $credentials): bool
    {
        if(!$user = $this->userResourceService->create($credentials)){
            return false;
        }

        Auth::loginUsingId($user->id);

        $user->sendEmailVerificationNotification();

        return true;
    }
}
