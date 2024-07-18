<?php

namespace App\Http\Controllers;

use App\Models\CarreraMateria;
use App\Models\Docente;
use App\Models\Gestion;
use App\Models\GrupoMateria;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Card;

class GrupoMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $search= $request->get('search');
        $grupoMaterias = GrupoMateria::where('sigla', 'like', "%{$search}%")
        ->orWhere('materia_sigla', 'like', "%{$search}%")->orWhere('docente_ci', 'like', "%{$search}%")
        ->orWhere('carrera_sigla', 'like', "%{$search}%")
        ->get();
        $carreraMaterias = CarreraMateria::all(); 
        $docentes = Docente::all();
        return view('grupo_materias.index', compact('grupoMaterias','visitas','carreraMaterias','docentes','search') );
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
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'sigla' => 'required|unique:grupo_materias,sigla|max:10',
            'descripcion' => 'required|max:255',
            'grupo_materia_id' => 'required|exists:carrera_materias,id',
            'docente_ci' => 'required|exists:docentes,ci',
        ], [
            'sigla.required' => 'La sigla es obligatoria',
            'sigla.unique' => 'La sigla ya está en uso',
            'sigla.max' => 'La sigla no puede tener más de 10 caracteres',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres',
            'grupo_materia_id.required' => 'El ID de la materia del grupo es obligatorio',
            'grupo_materia_id.exists' => 'El ID de la materia del grupo no existe',
            'docente_ci.required' => 'El CI del docente es obligatorio',
            'docente_ci.exists' => 'El CI del docente no existe',
        ]);
    
        try {
            // Iniciar una transacción
            DB::beginTransaction();
    
            // Encontrar la materia del grupo por su ID
            $carreraMateria = CarreraMateria::findOrFail($request->grupo_materia_id);
    
            // Crear el registro de GrupoMateria
            GrupoMateria::create([
                'sigla' => $request->sigla,
                'descripcion' => $request->descripcion,
                'materia_sigla' => $carreraMateria->materia_sigla,
                'carrera_sigla' => $carreraMateria->carrera_sigla,
                'docente_ci' => $request->docente_ci,
            ]);
    
            // Confirmar la transacción
            DB::commit();
    
            return redirect()->route('grupo_materias.index')->with('success', 'Grupo Materia creado con éxito');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
    
            // Registrar el error o manejarlo según sea necesario
            Log::error('Error al crear Grupo Materia: ' . $e->getMessage());
    
            return redirect()->route('grupo_materias.index')->with('error', 'Hubo un problema al crear el Grupo Materia. Por favor, inténtelo de nuevo.');
        }
    }
    
     /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrupoMateria  $grupoMateria
     * @return \Illuminate\Http\Response
     */
    public function show($sigla)
    {
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        $grupoMateria = GrupoMateria::find($sigla);
        return view('grupo_materias.show', compact('grupoMateria','visitas'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupoMateria  $grupoMateria
     * @return \Illuminate\Http\Response
     */
    public function edit($sigla)
    {
        $grupoMateria = GrupoMateria::find($sigla);
        return response()->json($grupoMateria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrupoMateria  $grupoMateria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sigla)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required|max:255',
            'materia_sigla' => 'required|exists:materias,sigla',
            'carrera_sigla' => 'required|exists:carreras,sigla',
            'docente_ci' => 'required|exists:docentes,ci',
        ], [
            'descripcion.required' => 'La descripción es obligatoria',
            'materia_sigla.required' => 'La sigla de la materia es obligatoria',
            'materia_sigla.exists' => 'La sigla de la materia no existe',
            'carrera_sigla.required' => 'La sigla de la carrera es obligatoria',
            'carrera_sigla.exists' => 'La sigla de la carrera no existe',
            'docente_ci.required' => 'El CI del docente es obligatorio',
            'docente_ci.exists' => 'El CI del docente no existe',
        ]);

        GrupoMateria::where('sigla', $sigla)->update($validatedData);

        return redirect()->route('grupo_materias.index')->with('success', 'Grupo Materia actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoMateria  $grupoMateria
     * @return \Illuminate\Http\Response
     */
    public function destroy($sigla)
    {
        $grupoMateria = GrupoMateria::findOrFail($sigla);
        $grupoMateria->delete();

        return redirect()->route('grupo_materias.index')->with('success', 'Grupo Materia eliminado con éxito');
    
    }
}
