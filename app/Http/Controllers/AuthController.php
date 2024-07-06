<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->intended('admin/dashboard');
        }

        // Autenticación fallida
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Método para el cierre de sesión
    public function showLoginForm()
    {
      
        return redirect('/'); // Redirige a la página de bienvenida
    }

     public function logout()
    {
        Auth::logout();
        return redirect('/'); // Redirige a la página de bienvenida
    }
  

}
