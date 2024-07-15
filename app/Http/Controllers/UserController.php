<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Role;
use App\Models\Tematica;
use App\Models\Tematicas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        $roles = Role::all();

        return view('users.index', compact('roles', 'usuarios'));
    }

    public function create()
    {    $usuarios = User::all();
        $roles = Role::all();

        return view('users.index', compact('roles', 'usuarios'));
    }
    public function store(Request $request)
    {
        // 1. Validation with Custom Messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:8', // At least 8 characters
            'rol_id' => 'required|exists:roles,id',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'rol_id.required' => 'El campo rol es obligatorio.',
            'rol_id.exists' => 'El rol seleccionado no es válido.',
        ]);

        // 2. Handle Validation Errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Repopulate the form with the input data
        }

        // 3. Create the User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol_id' => $request->rol_id,
            'tematica_id' => 1, // Set default temática
        ]);

        // 4. Redirect with Success Message
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {


        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email' . $id,
            'password' => 'nullable|string|min:8', // At least 8 characters if provided
            'rol_id' => 'required|exists:roles,id',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.unique' => 'Este email ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'rol_id.required' => 'El campo rol es obligatorio.',
            'rol_id.exists' => 'El rol seleccionado no es válido.',
        ]);
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'rol_id' => $request->rol_id,
            'tematica_id' => 1,
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
