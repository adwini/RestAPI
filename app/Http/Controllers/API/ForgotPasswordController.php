<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\SuccesController;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestStatus\Success;

class ForgotPasswordController extends Controller
{

    public function requestResetLink() {

    }

    public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // return $status === Password::RESET_LINK_SENT
        // ? response()-> json(["msg", "Reset link has sent to your email!"])
        // : response()-> json(["msg", "Email does not exist!"]);

        return $status === Password::RESET_LINK_SENT
        ? response()-> json(["msg", "Reset link has sent to your email!"])
        : back()->withErrors(['email' => __($status)]);

    }

    // public function resetUI(string $token) {
    //     return view('auth\reset_password', ['token' => $token]);
    // }

    public function succesReset(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );
            return redirect()->route('success');
        // return $status === Password::PASSWORD_RESET
        //     // ? view('auth\success')
        //     ? response()->json(['msg', 'Password reset success!'])
        //     : response()->json(['msg', 'Password reset failed!']);

        // return $status === Password::PASSWORD_RESET
        //     ? redirect()->route('login')->with('status', __($status))
        //     : back()->withErrors(['email' => [__($status)]]);
    }
}
