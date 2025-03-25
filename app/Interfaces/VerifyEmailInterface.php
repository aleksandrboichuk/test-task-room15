<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface VerifyEmailInterface
{
    public function verify(Request $request): bool;
}
