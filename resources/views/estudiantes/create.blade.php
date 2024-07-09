<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Estudiante</title>
</head>
<body>
    <h1>Crear Estudiante</h1>
    <form action="{{ route('estudiantes.store') }}" method="POST">
        @csrf
        <label for="ci">CI:</label>
        <input type="text" name="ci" id="ci" required>
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <label for="apellido_pat">Apellido Paterno:</label>
        <input type="text" name="apellido_pat" id="apellido_pat">
        <br>
        <label for="apellido_mat">Apellido Materno:</label>
        <input type="text" name="apellido_mat" id="apellido_mat">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono">
        <br>
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
        <br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
        <br>
        <label for="usuario_id">Usuario:</label>
        <select name="usuario_id" id="usuario_id" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->email }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit">Crear</button>
    </form>
    <a href="{{ route('estudiantes.index') }}">Regresar</a>
</body>
</html>
