<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validación
        $credentials = $request->only('email', 'password');
         
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

