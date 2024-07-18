<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
          // Contar visitas de la página actual
          Pagina::contarPagina(request()->path());

       
           // Obtener el número de visitas para la página actual
          $pagina = Pagina::where('path', request()->path())->first();
          $visitas = $pagina ? $pagina->visitas : 0;
        return view('auth.login',compact('visitas'));
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

