<?php

namespace App\Http\Controllers;

use App\Rules\LoginRule;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nrp'       => ['required', 'size:14', 'required_with:password', new LoginRule($request->password)],
            'password'  => ['required']
        ]);

        activity()->log('Login IP:' . request()->ip() . ' ' . request()->userAgent() . '<br>' . 'oleh user:' . auth()->user()->name);
        return redirect('/home');
    }

    public function logout()
    {
        activity()->log('Logout IP:' . request()->ip() . ' ' . request()->userAgent() . '<br>' . 'oleh user:' . auth()->user()->name);
        auth()->logout();
        return redirect()->route('login');
    }
}
