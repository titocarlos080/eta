<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrativoController extends Controller
{
    public function index()
    {
        $administrativos = Administrativo::with('usuario')->get();
        return view('administrativos.index', compact('administrativos'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('administrativos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|string|max:20',
            'nombre' => 'nullable|string|max:255',
            'apellido_pat' => 'nullable|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'email' => 'required|email|unique:administrativos,email',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
            'usuario_id' => 'required|exists:users,id',
        ]);

        Administrativo::create($request->all());

        return redirect()->route('administrativos.index')
                         ->with('success', 'Administrativo creado exitosamente.');
    }

    public function show(Administrativo $administrativo)
    {
        return view('administrativos.show', compact('administrativo'));
    }

    public function edit(Administrativo $administrativo)
    {
        $usuarios = User::all();
        return view('administrativos.edit', compact('administrativo', 'usuarios'));
    }

    public function update(Request $request, Administrativo $administrativo)
    {
        $request->validate([
            'ci' => 'required|string|max:20',
            'nombre' => 'nullable|string|max:255',
            'apellido_pat' => 'nullable|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'email' => 'required|email|unique:administrativos,email,' . $administrativo->ci . ',ci',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
            'usuario_id' => 'required|exists:users,id',
        ]);

        $administrativo->update($request->all());

        return redirect()->route('administrativos.index')
                         ->with('success', 'Administrativo actualizado exitosamente.');
    }

    public function destroy(Administrativo $administrativo)
    {
        $administrativo->delete();
        return redirect()->route('administrativos.index')
                         ->with('success', 'Administrativo eliminado exitosamente.');
    }
}
