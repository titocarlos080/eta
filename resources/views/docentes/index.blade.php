<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h1>Lista de Docentes</h1>
    <a href="{{ route('docentes.create') }}" class="btn btn-primary mb-3">Agregar Docente</a>
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
                <th>Kardex</th>
                <th>Curriculum</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->ci }}</td>
                    <td>{{ $docente->nombre }}</td>
                    <td>{{ $docente->apellido_pat }}</td>
                    <td>{{ $docente->apellido_mat }}</td>
                    <td>{{ $docente->email }}</td>
                    <td>{{ $docente->kardex }}</td>
                    <td>{{ $docente->curriculum }}</td>
                    <td>{{ $docente->usuario->name }}</td>
                    <td>
                        <a href="{{ route('docentes.show', $docente->ci) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('docentes.edit', $docente->ci) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('docentes.destroy', $docente->ci) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este docente?')">Eliminar</button>
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
