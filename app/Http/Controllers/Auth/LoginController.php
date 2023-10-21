<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view("auth.login");
    }

    public function showRegister()
    {
        return view("auth.register");
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        !is_null($remember) ? $remember = true : $remember = false;

        $user = User::where("email", $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            // Auth::loginUsingId($user->id);
            return redirect()->route("admin.index");
        } else {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => "Verdiginiz bilgilerle eslesen bir kullanici bulunamadi"
                ])
                ->onlyInput("email", "remember");
        }

    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route("login");
        }
    }

}