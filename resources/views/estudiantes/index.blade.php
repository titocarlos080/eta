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
                    <!-- Aquí va el contenido de la tarjeta -->
                    <a href="{{ route('estudiantes.create') }}" class="btn btn-primary mb-3">Crear Nuevo Estudiante</a>
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
                                        <a href="{{ route('estudiantes.show', $estudiante->ci) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('estudiantes.edit', $estudiante->ci) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('estudiantes.destroy', $estudiante->ci) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/theme.js') }}"></script>
@endpush
