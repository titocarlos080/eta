<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Http\Request;

class RoleMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $rol_menus = RoleMenu::all();
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        return view('permisos.index',compact('roles','rol_menus','visitas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleMenu  $roleMenu
     * @return \Illuminate\Http\Response
     */
    public function show(RoleMenu $roleMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleMenu  $roleMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleMenu $roleMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleMenu  $roleMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleMenu $roleMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleMenu  $roleMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleMenu $roleMenu)
    {
        //
    }
}
