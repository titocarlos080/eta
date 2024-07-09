<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrativos</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h1>Lista de Administrativos</h1>
    <a href="{{ route('administrativos.create') }}" class="btn btn-primary mb-3">Agregar Administrativo</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>CI</th>
                <th>Nombre</th>
                <th>Apellido Pat.</th>
                <th>Apellido Mat.</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Sexo</th>
                <th>Fecha de Nacimiento</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($administrativos as $administrativo)
                <tr>
                    <td>{{ $administrativo->ci }}</td>
                    <td>{{ $administrativo->nombre }}</td>
                    <td>{{ $administrativo->apellido_pat }}</td>
                    <td>{{ $administrativo->apellido_mat }}</td>
                    <td>{{ $administrativo->email }}</td>
                    <td>{{ $administrativo->telefono }}</td>
                    <td>{{ $administrativo->sexo }}</td>
                    <td>{{ $administrativo->fecha_nacimiento }}</td>
                    <td>{{ $administrativo->usuario->name }}</td>
                    <td>
                        <a href="{{ route('administrativos.show', $administrativo->ci) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('administrativos.edit', $administrativo->ci) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('administrativos.destroy', $administrativo->ci) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este administrativo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
