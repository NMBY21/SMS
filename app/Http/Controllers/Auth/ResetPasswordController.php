<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', trans($response));
        }

        throw ValidationException::withMessages(['email' => trans($response)]);
    }
}