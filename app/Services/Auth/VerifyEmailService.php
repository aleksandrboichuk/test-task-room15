<?php

namespace App\Services\Auth;

use App\Interfaces\VerifyEmailInterface;
use Illuminate\Http\Request;

class VerifyEmailService implements VerifyEmailInterface
{
    public function verify(Request $request): bool
    {
        $result = $request->user()->hasVerifiedEmail();

        if($result){
            $request->user()->markEmailAsVerified();
        }

        return $result;
    }
}
