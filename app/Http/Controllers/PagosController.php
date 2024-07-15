<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\carreras;
use App\Models\Estudiante;
use App\Models\Estudiantes;
use App\Models\niveles;
use App\Models\Pagina;
use App\Models\pagos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $pago=pagos::all();
        //$pagos = Pagos::with(['estudiante.carreras'])->get();
        return view('pagos.index',compact('pago','visitas'));
    }
    public function pdf(){
       $pagos=Pagos::all();
       $pdf = Pdf::loadView('pagos.pdf',compact('pagos'));
       return $pdf->stream();
    }
    public function lista()
    {
        $pagos=pagos::all();
        $estudiantes = Estudiante::with ('carreras')->orderBy('id', 'asc')->paginate(9);
        $carreras=Carrera::all();
        $carreras = Carrera::with('niveles')->get();
        return view('pagos.lista',compact('pagos','estudiantes','carreras'));
    }
   
    public function search(Request $request)
    {
        
        if($request->ajax()){
 
            $data=Estudiante::where('id','like','%'.$request->search.'%')
            ->orwhere('nombre','like','%'.$request->search.'%')
            ->orwhere('apellidos','like','%'.$request->search.'%')->get();
            
            return response()->json($data);
            
        }
       
    }

    public function getEstudianteInfo($id)
    {
        $estudiante = Estudiante::find($id);
        
        if (!$estudiante) {
            return response()->json(['success' => false, 'message' => 'Estudiante no encontrado'], 404);
        }
        
        // Obtener el ID de la carrera y el nivel
        $carreraNivelIds = explode('_', $estudiante->carrera_nivel);
        $carreraId = $carreraNivelIds[0];
        $nivelId = $carreraNivelIds[1];
        
        // Buscar el nombre de la carrera y el nivel
        $carrera = Carrera::find($carreraId);
        $nivel = niveles::find($nivelId);
    
        if (!$carrera || !$nivel) {
            return response()->json(['success' => false, 'message' => 'Carrera o nivel no encontrado'], 404);
        }
    
        // Combinar el nombre de la carrera y el nivel
        $carreraNivel = $carrera->nombre . ' - ' . $nivel->nombre;
    
        return response()->json([
            'success' => true,
            'carreraNivel' => $carreraNivel,
        ]);
    }
    

    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
     {
         $pago = pagos::get();
         return view('pagos.index', compact('pago'));
     }
     
        //$pagos = Pagos::with(['estudiante.carreras'])->get();
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)

{
    $request->validate([
        'concepto' => 'required',
        'fecha' => 'required',
        'monto' => 'required',
        'meses' => 'required|array', // Asumiendo que 'meses' es un array enviado desde el formulario
        'estudiante_id' => 'required|exists:estudiantes,id', // Asegúrate de ajustar el nombre de la tabla si es diferente
    ]);
    // Obtén los nombres de los meses seleccionados
    $selectedMonths = $request->input('meses');

    // Convierte los nombres de los meses en una cadena separada por comas
    $mesesPagados = implode(', ', $selectedMonths);

    // Crear un nuevo objeto Pago con los datos recibidos
    $pago = Pagos::create([
        'concepto' => $request->input('concepto'),
        'fecha' => $request->input('fecha'),
        'monto' => $request->input('monto'),
        'mes_pago' => $mesesPagados,
        'estudiante_id' => $request->input('estudiante_id'),
    ]);

    // Guardar el pago en la base de datos
    $pago->save();
    // Redireccionar o devolver una respuesta según sea necesario
    return redirect()->route('pagos.show', $pago->id);
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {  
        $pago = Pagos::findOrFail($id);
        return view('pagos.show', compact('pago'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function edit(pagos $pagos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pagos $pagos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pagos  $pagos
     * @return \Illuminate\Http\Response
     */
    public function destroy(pagos $pagos)
    {
        //
    }

    public function pagarQr()
    {     Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        return view("pagos.prueba",compact('visitas'));
        // 

    
    }




    
}
