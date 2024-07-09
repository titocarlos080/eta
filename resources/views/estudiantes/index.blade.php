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
