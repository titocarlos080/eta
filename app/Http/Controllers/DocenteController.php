<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    // Muestra la lista de docentes
    public function index()
    {     Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $docentes = Docente::all(); // Obtiene todos los docentes
        return view('docentes.index', compact('docentes','visitas'));
    }

    // Muestra el formulario para crear un nuevo docente
    public function create()
    {
        return view('docentes.create');
    }

    // Almacena un nuevo docente en la base de datos
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'ci' => 'required|string|max:20|unique:docentes,ci',
            'nombre' => 'required|string|max:255',
            'apellido_pat' => 'required|string|max:255',
            'apellido_mat' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email',
            'kardex' => 'nullable|string|max:255',
            'curriculum' => 'nullable|string|max:255',
         ]);

        try {
            // Crea el usuario asociado
            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Usa la contraseña ingresada
                'rol_id' => 2, 
                'tematica_id' => 1, 
            ]);

            // Crea el docente asociado al usuario
            Docente::create(array_merge($request->all(), ['usuario_id' => $user->id]));

            return redirect()->route('docentes.index')
                ->with('success', 'Docente registrado exitosamente.');
        } catch (\Exception $e) {
            // Redirige de vuelta con un mensaje de error
            return redirect()->back()
                ->with('error', 'Error al registrar el docente. Por favor, intente de nuevo.')
                ->withInput(); // Mantiene los datos del formulario
        }
    }

    // Muestra los detalles de un docente
    public function show($ci)
    {
        $docente = Docente::findOrFail($ci);
        return view('docentes.show', compact('docente'));
    }

    // Muestra el formulario para editar un docente
    public function edit($ci)
    {
        $docente = Docente::findOrFail($ci);
        return view('docentes.edit', compact('docente'));
    }

    // Actualiza un docente en la base de datos
    public function update(Request $request, $ci)
    {
        // Validar los datos del formulario
        $request->validate([
            'ci' => 'required|string|max:20|exists:docentes,ci',
            'nombre' => 'required|string|max:255',
            'apellido_pat' => 'required|string|max:255',
            'apellido_mat' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email,' . $ci . ',ci',
            'kardex' => 'nullable|string|max:255',
            'curriculum' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // La contraseña es opcional en la actualización
        ]);

        try {
            $docente = Docente::findOrFail($ci);

            // Actualizar el docente
            $docente->update($request->except('password'));

            // Si se proporciona una nueva contraseña, actualizar el usuario asociado
            if ($request->filled('password')) {
                $docente->usuario->update([
                    'name' => $request->nombre,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                // Solo actualizar el nombre y email si no hay nueva contraseña
                $docente->usuario->update([
                    'name' => $request->nombre,
                    'email' => $request->email,
                ]);
            }

            return redirect()->route('docentes.index')
                ->with('success', 'Docente actualizado exitosamente.');
        } catch (\Exception $e) {
            // Redirige de vuelta con un mensaje de error
            return redirect()->back()
                ->with('error', 'Error al actualizar el docente. Por favor, intente de nuevo.')
                ->withInput(); // Mantiene los datos del formulario
        }
    }

    // Elimina un docente de la base de datos
    public function destroy($ci)
    {
        try {
            $docente = Docente::findOrFail($ci);

            if ($docente->usuario) {
                $docente->usuario->delete(); // Elimina el usuario asociado
            }

            $docente->delete(); // Elimina el docente

            return redirect()->route('docentes.index')
                ->with('success', 'Docente eliminado exitosamente.');
        } catch (\Exception $e) {
            // Redirige de vuelta con un mensaje de error
            return redirect()->back()
                ->with('error', 'Error al eliminar el docente. Por favor, intente de nuevo.');
        }
    }
}
