<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Usuario</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="name" name="name" id="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="rol_id">Rol:</label>
        <select name="rol_id" id="rol_id" required>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
            @endforeach
        </select>
        <br>
        <label for="tematica_id">Temática:</label>
        <select name="tematica_id" id="tematica_id" required>
            @foreach($tematicas as $tematica)
                <option value="{{ $tematica->id }}">{{ $tematica->nombre }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit">Guardar</button>
    </form>
    <a href="{{ route('users.index') }}">Regresar</a>
</body>
</html>
