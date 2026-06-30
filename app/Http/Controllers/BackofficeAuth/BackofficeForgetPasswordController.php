<?php

namespace App\Http\Controllers\BackofficeAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class BackofficeForgetPasswordController extends Controller
{
    public function backofficeForgetPassword(): View
    {
        return view('backoffice.auth.backoffice_forgot_password');
    } // End Method

    public function backofficeForgetPasswordStore(ForgotPasswordRequest $request): RedirectResponse
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->safe()->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->safe()->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
