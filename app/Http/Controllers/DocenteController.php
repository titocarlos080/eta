<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('usuario')->get();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('docentes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|string|max:20',
            'nombre' => 'nullable|string|max:255',
            'apellido_pat' => 'nullable|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'email' => 'required|email|unique:docentes,email',
            'kardex' => 'nullable|string|max:255',
            'curriculum' => 'nullable|string|max:255',
            'usuario_id' => 'required|exists:users,id',
        ]);

        Docente::create($request->all());

        return redirect()->route('docentes.index')
                         ->with('success', 'Docente creado exitosamente.');
    }

    public function show(Docente $docente)
    {
        return view('docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        $usuarios = User::all();
        return view('docentes.edit', compact('docente', 'usuarios'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'ci' => 'required|string|max:20',
            'nombre' => 'nullable|string|max:255',
            'apellido_pat' => 'nullable|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'email' => 'required|email|unique:docentes,email,' . $docente->ci . ',ci',
            'kardex' => 'nullable|string|max:255',
            'curriculum' => 'nullable|string|max:255',
            'usuario_id' => 'required|exists:users,id',
        ]);

        $docente->update($request->all());

        return redirect()->route('docentes.index')
                         ->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('docentes.index')
                         ->with('success', 'Docente eliminado exitosamente.');
    }
}
