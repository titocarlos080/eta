<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministrativoController extends Controller
{
    // Muestra la lista de administrativos
    public function index()
    {     Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $administrativos = Administrativo::all(); // Obtiene todos los administrativos
        return view('administrativos.index', compact('administrativos','visitas'));
    }

    // Muestra el formulario para crear un nuevo administrativo
    public function create()
    {     Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        return view('administrativos.create','visitas');
    }

    // Almacena un nuevo administrativo en la base de datos
    public function store(Request $request)
    {
        // Valida los datos del formulario
        // Define mensajes de error personalizados
        $messages = [
            'ci.required' => 'El CI es obligatorio.',
            'ci.string' => 'El CI debe ser una cadena de texto.',
            'ci.max' => 'El CI no puede tener más de 20 caracteres.',
            'ci.unique' => 'El CI ya está registrado.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'apellido_pat.required' => 'El apellido paterno es obligatorio.',
            'apellido_pat.string' => 'El apellido paterno debe ser una cadena de texto.',
            'apellido_pat.max' => 'El apellido paterno no puede tener más de 255 caracteres.',
            'apellido_mat.required' => 'El apellido materno es obligatorio.',
            'apellido_mat.string' => 'El apellido materno debe ser una cadena de texto.',
            'apellido_mat.max' => 'El apellido materno no puede tener más de 255 caracteres.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.unique' => 'El email ya está registrado.',
            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.string' => 'El sexo debe ser una cadena de texto.',
            'sexo.max' => 'El sexo no puede tener más de 1 caracter.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        $request->validate([
            'ci' => 'required|string|max:20|unique:administrativos,ci',
            'nombre' => 'required|string|max:255',
            'apellido_pat' => 'required|string|max:255',
            'apellido_mat' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:administrativos,email',
            'sexo' => 'required|string|max:1',
            'fecha_nacimiento' => 'required|date',
         ], $messages);

        try {
            // Crea el usuario asociado
            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->ci), // Usa la contraseña ingresada
                'rol_id' => 1, // Asigna un rol adecuado
                'tematica_id' => 1, // Asigna una temática adecuada
            ]);

            // Crea el administrativo asociado al usuario
            Administrativo::create(array_merge($request->all(), ['usuario_id' => $user->id]));

            return redirect()->route('administrativos.index')
                ->with('success', 'Administrativo registrado exitosamente.');
        } catch (\Exception $e) {
            // Redirige de vuelta con un mensaje de error
            return redirect()->back()
                ->with('error', 'Error al registrar el administrativo. Por favor, intente de nuevo.')
                ->withInput(); // Mantiene los datos del formulario
        }
    }

    // Muestra los detalles de un administrativo
    public function show($ci)
    {
        $administrativo = Administrativo::findOrFail($ci);
        return view('administrativos.show', compact('administrativo'));
    }

    // Muestra el formulario para editar un administrativo
    public function edit($ci)
    {      Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $administrativo = Administrativo::findOrFail($ci);
        return view('administrativos.edit', compact('administrativo','visitas'));
    }

    // Actualiza un administrativo en la base de datos
    public function update(Request $request, $ci)
    {
        $messages = [
            'ci.required' => 'El CI es obligatorio.',
            'ci.string' => 'El CI debe ser una cadena de texto.',
            'ci.max' => 'El CI no puede tener más de 20 caracteres.',
            'ci.exists' => 'El CI no está registrado.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'apellido_pat.required' => 'El apellido paterno es obligatorio.',
            'apellido_pat.string' => 'El apellido paterno debe ser una cadena de texto.',
            'apellido_pat.max' => 'El apellido paterno no puede tener más de 255 caracteres.',
            'apellido_mat.required' => 'El apellido materno es obligatorio.',
            'apellido_mat.string' => 'El apellido materno debe ser una cadena de texto.',
            'apellido_mat.max' => 'El apellido materno no puede tener más de 255 caracteres.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.unique' => 'El email ya está registrado.',
            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.string' => 'El sexo debe ser una cadena de texto.',
            'sexo.max' => 'El sexo no puede tener más de 1 caracter.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        ];

        // Valida los datos del formulario
        $request->validate([
            'ci' => 'required|string|max:20|exists:administrativos,ci',
            'nombre' => 'required|string|max:255',
            'apellido_pat' => 'required|string|max:255',
            'apellido_mat' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:administrativos,email,' . $ci . ',ci',
            'sexo' => 'required|string|max:1',
            'fecha_nacimiento' => 'required|date',
        ], $messages);

        try {
            $administrativo = Administrativo::findOrFail($ci);

            // Actualizar el administrativo
            $administrativo->update($request->except('password'));

            // Si se proporciona una nueva contraseña, actualizar el usuario asociado
            if ($request->filled('password')) {
                $administrativo->usuario->update([
                    'name' => $request->nombre,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                // Solo actualizar el nombre y email si no hay nueva contraseña
                $administrativo->usuario->update([
                    'name' => $request->nombre,
                    'email' => $request->email,
                ]);
            }

            return redirect()->route('administrativos.index')
                ->with('success', 'Administrativo actualizado exitosamente.');
        } catch (\Exception $e) {
            // Redirige de vuelta con un mensaje de error
            return redirect()->back()
                ->with('error', 'Error al actualizar el administrativo. Por favor, intente de nuevo.')
                ->withInput(); // Mantiene los datos del formulario
        }
    }

    // Elimina un administrativo de la base de datos
    public function destroy($ci)
    {
        try {
            $administrativo = Administrativo::findOrFail($ci);

            if ($administrativo->usuario) {
                $administrativo->usuario->delete(); // Elimina el usuario asociado
            }

            $administrativo->delete(); // Elimina el administrativo

            return redirect()->route('administrativos.index')
                ->with('success', 'Administrativo eliminado exitosamente.');
        } catch (\Exception $e) {
            // Redirige de vuelta con un mensaje de error
            return redirect()->back()
                ->with('error', 'Error al eliminar el administrativo. Por favor, intente de nuevo.');
        }
    }
}
