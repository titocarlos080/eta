<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Docente</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Docente</h1>
    <form action="{{ route('docentes.update', $docente->ci) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ci">CI</label>
            <input type="text" name="ci" id="ci" class="form-control" value="{{ $docente->ci }}" readonly>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $docente->nombre }}">
        </div>
        <div class="form-group">
            <label for="apellido_pat">Apellido Paterno</label>
            <input type="text" name="apellido_pat" id="apellido_pat" class="form-control" value="{{ $docente->apellido_pat }}">
        </div>
        <div class="form-group">
            <label for="apellido_mat">Apellido Materno</label>
            <input type="text" name="apellido_mat" id="apellido_mat" class="form-control" value="{{ $docente->apellido_mat }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $docente->email }}" required>
        </div>
        <div class="form-group">
            <label for="kardex">Kardex</label>
            <input type="text" name="kardex" id="kardex" class="form-control" value="{{ $docente->kardex }}">
        </div>
        <div class="form-group">
            <label for="curriculum">Curriculum</label>
            <input type="text" name="curriculum" id="curriculum" class="form-control" value="{{ $docente->curriculum }}">
        </div>
        <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-control" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $usuario->id == $docente->usuario_id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
