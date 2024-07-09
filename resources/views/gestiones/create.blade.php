<!DOCTYPE html>
<html>
<head>
    <title>Crear Gestión</title>
 </head>
<body>
    <div class="container">
        <h1>Crear Gestión</h1>
        <form action="{{ route('gestiones.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
