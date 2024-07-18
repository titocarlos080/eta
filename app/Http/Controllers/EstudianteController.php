<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Pagina;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstudianteController extends Controller
{
    public function index(Request $request)
    {     
        
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $search= $request->get('search');
        $estudiantes = Estudiante::where('ci', 'like', "%{$search}%")
        ->orWhere('nombre', 'like', "%{$search}%")
        ->orWhere('apellido_pat', 'like', "%{$search}%")
        ->get();
        //$estudiantes = Estudiante::all();

        return view('estudiantes.index', compact('estudiantes','visitas','search') );
    }

    public function create()
    {
        
        return view('estudiantes.create' );
    }
    public function generatePDF()
    {
        $estudiantes = Estudiante::all();
        $pdf = Pdf::loadView('estudiantes.pdf', compact('estudiantes'));

        return $pdf->download('estudiantes.pdf');
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'ci' => 'required|string|max:20|unique:estudiantes,ci', // Asegúrate de que 'ci' sea único
            'nombre' => 'nullable|string|max:255',
            'apellido_pat' => 'nullable|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'email' => 'required|email|unique:usuarios,email', // La validación debe ser en la tabla de usuarios
            'telefono' => 'nullable|string|max:255',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
         ]);
    
        try {
            // Crear un nuevo usuario
            $newUser = new User();
            $newUser->name = $request->nombre;
            $newUser->email = $request->email;
            $newUser->password = Hash::make($request->ci); // La contraseña será el CI del estudiante
            $newUser->rol_id = 3; // Asigna el rol predeterminado
            $newUser->tematica_id = 1; // Asigna la temática predeterminada
            $newUser->save();
    
            // Actualizar el ID del usuario en la solicitud para la creación del estudiante
            $request->merge(['usuario_id' => $newUser->id]);
    
            // Crear el estudiante
            Estudiante::create($request->all());
    
            // Redireccionar a la lista de estudiantes con un mensaje de éxito
            return redirect()->route('estudiantes.index')
                             ->with('success', 'Estudiante creado exitosamente.');
        } catch (\Throwable $th) {
            // Manejo de excepciones
            return redirect()->route('estudiantes.index')
                             ->with('error', 'Ocurrió un error al crear el estudiante. Intenta nuevamente.');
        }
    }
    

    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        $usuarios = User::all();
        return view('estudiantes.edit', compact('estudiante', 'usuarios'));
    }

    public function update(Request $request, Estudiante $estudiante)
{
    $request->validate([
        'ci' => 'required|string|max:20',
        'nombre' => 'nullable|string|max:255',
        'apellido_pat' => 'nullable|string|max:255',
        'apellido_mat' => 'nullable|string|max:255',
        'email' => 'required|email|unique:estudiantes,email,' . $estudiante->ci . ',ci', // Corregido
        'telefono' => 'nullable|string|max:255',
        'sexo' => 'required|in:M,F',
        'fecha_nacimiento' => 'required|date',
     ]);
    
    $estudiante->update($request->all());

    return redirect()->route('estudiantes.index')
        ->with('success', 'Estudiante actualizado exitosamente.');
}

public function destroy(Estudiante $estudiante)
{
    try {
        // Encuentra el usuario asociado al estudiante
        $usuario = $estudiante->usuario; // Obtén el usuario directamente desde el estudiante

        // Elimina el estudiante
        $estudiante->delete();

        // Elimina el usuario asociado si existe
        if ($usuario) {
            $usuario->delete();
        }

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante y usuario asociados eliminados exitosamente.');
    } catch (\Exception $e) {
        // Manejo de excepciones para capturar cualquier error
        return redirect()->route('estudiantes.index')
            ->with('error', 'Ocurrió un error al eliminar el estudiante y el usuario.');
    }
}

}
