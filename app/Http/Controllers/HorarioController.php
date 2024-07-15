<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::all();
        return view('horarios.index', compact('horarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        Horario::create($request->all());

        return redirect()->route('horarios.index')->with('success', 'Horario creado exitosamente');
    }
    public function show( $id)
    {
        $horario= Horario::findOrFail($id);
        return view('horarios.show', compact('horario'));
    } 
    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        return response()->json($horario);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        $horario = Horario::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado exitosamente');
    }

    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return redirect()->route('horarios.index')->with('success', 'Horario eliminado exitosamente');
    }
}
