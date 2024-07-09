<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:menus',
            'ruta' => 'required|string|max:255|unique:menus',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menú creado con éxito.');
    }

    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:menus,nombre,' . $menu->id,
            'ruta' => 'required|string|max:255|unique:menus,ruta,' . $menu->id,
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menú actualizado con éxito.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menú eliminado con éxito.');
    }
}
