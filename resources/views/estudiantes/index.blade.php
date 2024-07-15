@extends('adminlte::page')

@section('title', 'Estudiantes')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><strong>LISTA DE ESTUDIANTES</strong></h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">Nuevo</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed">
                    <thead class="table-light">
                        <tr>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                             <th>Email</th>
                             <th>Sexo</th>
                             <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                        <tr>
                            <td>{{ $estudiante->ci }}</td>
                            <td>{{ $estudiante->nombre }}</td>
                            <td>{{ $estudiante->apellido_pat }}</td>
                             <td>{{ $estudiante->email }}</td>
                             <td>{{ $estudiante->sexo }}</td>
                             <td>
                                <!-- Botón Ver -->
                                <a href="{{ route('estudiantes.show', $estudiante->ci) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Botón Editar -->
                                <a href="{{ route('estudiantes.edit', $estudiante->ci) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('estudiantes.destroy', $estudiante->ci) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
@stop