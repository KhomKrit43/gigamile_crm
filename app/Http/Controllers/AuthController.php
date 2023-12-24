<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\LogLogin;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (auth()->check()) {
            return redirect('/');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (auth()->attempt($credentials)) {
            $login = new LogLogin();
            $login->email = $request->email;
            $login->ip = $request->ip();
            $login->user_agent = $request->userAgent();
            $login->status = 'login';
            $login->save();
            return redirect('/');
        } else {
            $login = new LogLogin();
            $login->email = $request->email;
            $login->ip = $request->ip();
            $login->user_agent = $request->userAgent();
            $login->status = 'login failed';
            $login->save();
        }

        return redirect()
            ->back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ]);
    }

    public function logout()
    {
        $login = new LogLogin();
        $login->email = auth()->user()->email;
        $login->ip = request()->ip();
        $login->user_agent = request()->userAgent();
        $login->status = 'logout';
        $login->save();

        auth()->logout();

        return redirect()->route('login');
    }
}
