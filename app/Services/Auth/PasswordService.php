<?php

namespace App\Services\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class PasswordService
{
    public function sendResetLink(string $email): string
    {
        return Password::sendResetLink(compact('email'));
    }


    public function validateToken($token): string|false
    {
        if (!$this->isValidTokenFormat($token)) {
            return false;
        }

        $passwordReset = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            return false;
        }

        $tokenCreatedAt = Carbon::parse($passwordReset->created_at);
        $expiresAt = $tokenCreatedAt->addMinutes(60);

        if (Carbon::now()->greaterThan($expiresAt)) {
            DB::table('password_resets')
                ->where('token', $token)
                ->delete();

            return false;
        }

        return $passwordReset->email;
    }

    protected function isValidTokenFormat($token): bool
    {
        return is_string($token) &&
            strlen($token) >= 60 &&
            preg_match('/^[a-zA-Z0-9]+$/', $token);
    }
}
