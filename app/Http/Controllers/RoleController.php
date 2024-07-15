<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {     Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $roles = Role::all();
        return view('roles.index', compact('roles','visitas'));
    }

    public function create()
    {
        // Return view if needed
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
         return response()->json($role);
      
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index');
    }
}
