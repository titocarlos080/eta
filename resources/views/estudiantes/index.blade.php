<<<<<<< HEAD
@extends('adminlte::page')

@section('title', 'Estudiantes')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE ESTUDIANTES</strong>
                            <a class="btn" href="{{ route('estudiantes.index') }}">
                                <i class="fas fa-sync fa-md fa-fw"></i>
                            </a>
                        </h3>
                    </div>

                    <div class="col-xs">
                        <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary"
                            type="button">Nuevo</button>
                    </div>
                    <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fomrCreateLabel">Registrar nuevo </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('partials.estudiantes.form_create')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed">
                    <thead class="table-light ">
                        <tr>
                            <th>ID</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>CARNET <br>IDENTIDAD</th>
                            <th>CARRERA-NIVEL</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                        <tr>
                            <td>{{ $estudiante->id }}</td>
                            <td>{{ $estudiante->nombre }}</td>
                            <td>{{ $estudiante->apellidos }}</td>
                            <td>{{ $estudiante->carnet }}</td>
                            <td>
                                @if($estudiante->carreras->isNotEmpty())
                                {{ $estudiante->carreras->first()->carrera_nombre . ' - ' .
                                $estudiante->carreras->first()->nivel_nombre }}
                                @else
                                Sin carrera
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" onclick="editEstudiante({{ $estudiante->id }})">Editar</button>
                                <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Incluir el formulario de edición -->
@include('partials.estudiantes.form_edit')
@stop
<script>
    function editEstudiante(id) {
        fetch(`/estudiantes/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editNombre').value = data.estudiante.nombre;
                document.getElementById('editApellidos').value = data.estudiante.apellidos;
                document.getElementById('editCarnet').value = data.estudiante.carnet;

                const select = document.getElementById('editCarreraNivel');
                select.innerHTML = ''; // Limpiar opciones existentes

                data.carreras.forEach(carrera => {
                    const option = document.createElement('option');
                    option.value = carrera.id;
                    option.textContent = `${carrera.nombre} - ${carrera.niveles.map(nivel => nivel.nombre).join(', ')}`;
                    if (data.estudiante.carrera_nivel == carrera.id) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                });

                document.getElementById('editEstudianteForm').action = `/estudiantes/${id}`;
                $('#formEditModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }
</script>

@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>

@endpush

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
</head>
<body>
    <h1>Lista de Estudiantes</h1>
    <a href="{{ route('estudiantes.create') }}">Crear Nuevo Estudiante</a>
    <table>
        <thead>
            <tr>
                <th>CI</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th> 
                <th>Apellido Materno</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Sexo</th>
                <th>Fecha de Nacimiento</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->ci }}</td>
                    <td>{{ $estudiante->nombre }}</td>
                    <td>{{ $estudiante->apellido_pat }}</td>
                    <td>{{ $estudiante->apellido_mat }}</td>
                    <td>{{ $estudiante->email }}</td>
                    <td>{{ $estudiante->telefono }}</td>
                    <td>{{ $estudiante->sexo }}</td>
                    <td>{{ $estudiante->fecha_nacimiento  }}</td>
                    <td>{{ $estudiante->usuario->email }}</td>
                    <td>
                        <a href="{{ route('estudiantes.show', $estudiante->ci) }}">Ver</a>
                        <a href="{{ route('estudiantes.edit', $estudiante->ci) }}">Editar</a>
                        <form action="{{ route('estudiantes.destroy', $estudiante->ci) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
>>>>>>> tito
