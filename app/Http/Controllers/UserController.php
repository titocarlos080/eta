<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Role;
use App\Models\Tematica;
use App\Models\Tematicas;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('rol', 'tematica')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $tematicas = Tematica::all();
        return view('users.create', compact('roles', 'tematicas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:usuarios,email',
            'name' => 'required',
            'password' => 'required',
            'rol_id' => 'required|exists:roles,id',
            'tematica_id' => 'required|exists:tematicas,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol_id' => $request->rol_id,
            'tematica_id' => $request->tematica_id,
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $tematicas = Tematica::all();
        return view('users.edit', compact('user', 'roles', 'tematicas'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required'  ,
            'email' => 'required|email|unique:usuarios,email,' . $user->id,
            'password' => 'nullable',
            'rol_id' => 'required|exists:roles,id',
            'tematica_id' => 'required|exists:tematicas,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'rol_id' => $request->rol_id,
            'tematica_id' => $request->tematica_id,
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
                         ->with('success', 'Usuario eliminado exitosamente.');
    }
}
