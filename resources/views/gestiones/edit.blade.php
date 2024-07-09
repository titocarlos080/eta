<!DOCTYPE html>
<html>
<head>
    <title>Editar Gestión</title>
 </head>
<body>
    <div class="container">
        <h1>Editar Gestión</h1>
        <form action="{{ route('gestiones.update', $gestion) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $gestion->descripcion }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $gestion->fecha_inicio }}">
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $gestion->fecha_fin }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
