@extends('adminlte::page')

@section('title', 'carreras')

@section('content')

<div class="container">
    <h1>Carreras</h1>
    <a href="{{ route('carreras.create') }}" class="btn btn-primary">Nueva Carrera</a>
    <table class="table">
        <thead>
            <tr>
                <th>Sigla</th>
                <th>Descripción</th>
                <th>Gestión</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
            <tr>
                <td>{{ $carrera->sigla }}</td>
                <td>{{ $carrera->descripcion }}</td>
                <td>{{ $carrera->gestion->descripcion }}</td>
                <td>
                    <a href="{{ route('carreras.show', $carrera) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('carreras.edit', $carrera) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('carreras.destroy', $carrera) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>