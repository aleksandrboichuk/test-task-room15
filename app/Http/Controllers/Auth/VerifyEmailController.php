<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\VerifyEmailInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __construct(
        protected VerifyEmailInterface $verifyEmailService
    )
    {}

    public function verifyPage(): View
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request): RedirectResponse
    {
        $this->verifyEmailService->verify($request);

        return redirect()->intended('/home');
    }

    public function resendVerification()
    {

    }
}
