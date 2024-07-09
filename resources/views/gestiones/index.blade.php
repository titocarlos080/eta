<!DOCTYPE html>
<html>
<head>
    <title>Gestiones</title>
 </head>
<body>
    <div class="container">
        <h1>Gestiones</h1>
        <a href="{{ route('gestiones.create') }}" class="btn btn-primary">Nueva Gestión</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gestiones as $gestion)
                <tr>
                    <td>{{ $gestion->codigo }}</td>
                    <td>{{ $gestion->descripcion }}</td>
                    <td>{{ $gestion->fecha_inicio }}</td>
                    <td>{{ $gestion->fecha_fin }}</td>
                    <td>
                        <a href="{{ route('gestiones.show', $gestion) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('gestiones.edit', $gestion) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('gestiones.destroy', $gestion) }}" method="POST" style="display:inline;">
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
</body>
</html>
