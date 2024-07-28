<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


class ResetPasswordController extends Controller
{
    //
    public function showResetForm(Request $request, $token){
        return view('Auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'token' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('auth.index')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
