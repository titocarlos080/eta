@extends('adminlte::page')

@section('title', 'Lista de Estudiantes')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col text-center">
                            <h3 class="card-title">
                                <strong>LISTA DE ESTUDIANTES</strong>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createEstudianteModal">Crear Nuevo Estudiante</button>
                    <table class="table table-striped">
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
                                    <td>{{ $estudiante->fecha_nacimiento }}</td>
                                    <td>{{ $estudiante->usuario->email }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewEstudianteModal-{{ $estudiante->ci }}">Ver</button>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editEstudianteModal-{{ $estudiante->ci }}">Editar</button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEstudianteModal-{{ $estudiante->ci }}">Eliminar</button>
                                    </td>
                                </tr>
                                
                                <!-- Modal Ver Estudiante -->
                                <div class="modal fade" id="viewEstudianteModal-{{ $estudiante->ci }}" tabindex="-1" role="dialog" aria-labelledby="viewEstudianteLabel-{{ $estudiante->ci }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewEstudianteLabel-{{ $estudiante->ci }}">Ver Estudiante</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Contenido del modal para ver el estudiante -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Editar Estudiante -->
                                <div class="modal fade" id="editEstudianteModal-{{ $estudiante->ci }}" tabindex="-1" role="dialog" aria-labelledby="editEstudianteLabel-{{ $estudiante->ci }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editEstudianteLabel-{{ $estudiante->ci }}">Editar Estudiante</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Incluir el formulario de edición -->
                                                @include('estudiantes.edit', ['estudiante' => $estudiante])
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Eliminar Estudiante -->
                                <div class="modal fade" id="deleteEstudianteModal-{{ $estudiante->ci }}" tabindex="-1" role="dialog" aria-labelledby="deleteEstudianteLabel-{{ $estudiante->ci }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteEstudianteLabel-{{ $estudiante->ci }}">Eliminar Estudiante</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('estudiantes.destroy', $estudiante->ci) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>¿Estás seguro de que deseas eliminar este estudiante?</p>
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Crear Estudiante -->
    <div class="modal fade" id="createEstudianteModal" tabindex="-1" role="dialog" aria-labelledby="createEstudianteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEstudianteLabel">Crear Nuevo Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Incluir el formulario de creación -->
                    @include('estudiantes.create')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/theme.js') }}"></script>
@endpush
