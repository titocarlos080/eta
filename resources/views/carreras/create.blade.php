<!DOCTYPE html>
<html>
<head>
    <title>Crear Carrera</title>
 </head>
<body>
    <div class="container">
        <h1>Crear Carrera</h1>
        <form action="{{ route('carreras.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sigla">Sigla</label>
                <input type="text" name="sigla" id="sigla" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gestion_codigo">Gestión</label>
                <select name="gestion_codigo" id="gestion_codigo" class="form-control" required>
                    @foreach ($gestiones as $gestion)
                        <option value="{{ $gestion->codigo }}">{{ $gestion->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
