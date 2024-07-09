<!DOCTYPE html>
<html>
<head>
    <title>Editar Carrera</title>
 </head>
<body>
    <div class="container">
        <h1>Editar Carrera</h1>
        <form action="{{ route('carreras.update', $carrera) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="sigla">Sigla</label>
                <input type="text" name="sigla" id="sigla" class="form-control" value="{{ $carrera->sigla }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $carrera->descripcion }}" required>
            </div>
            <div class="form-group">
                <label for="gestion_codigo">Gestión</label>
                <select name="gestion_codigo" id="gestion_codigo" class="form-control" required>
                    @foreach ($gestiones as $gestion)
                        <option value="{{ $gestion->codigo }}" {{ $gestion->codigo == $carrera->gestion_codigo ? 'selected' : '' }}>{{ $gestion->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
