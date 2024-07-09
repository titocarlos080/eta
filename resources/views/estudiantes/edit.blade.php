<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
</head>
<body>
    <h1>Editar Estudiante</h1>
    <form action="{{ route('estudiantes.update', $estudiante->ci) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="ci">CI:</label>
        <input type="text" name="ci" id="ci" value="{{ $estudiante->ci }}" required readonly>
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ $estudiante->nombre }}">
        <br>
        <label for="apellido_pat">Apellido Paterno:</label>
        <input type="text" name="apellido_pat" id="apellido_pat" value="{{ $estudiante->apellido_pat }}">
        <br>
        <label for="apellido_mat">Apellido Materno:</label>
        <input type="text" name="apellido_mat" id="apellido_mat" value="{{ $estudiante->apellido_mat }}">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $estudiante->email }}" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="{{ $estudiante->telefono }}">
        <br>
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="M" {{ $estudiante->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ $estudiante->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
        </select>
        <br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $estudiante->fecha_nacimiento->format('Y-m-d') }}" required>
        <br>
        <label for="usuario_id">Usuario:</label>
        <select name="usuario_id" id="usuario_id" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ $usuario->id == $estudiante->usuario_id ? 'selected' : '' }}>{{ $usuario->email }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="{{ route('estudiantes.index') }}">Regresar</a>
</body>
</html>
