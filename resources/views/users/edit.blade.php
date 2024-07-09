<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nombre:</label>
        <input type="name" name="name" id="name" value="{{ $user->name }}" required>
        <br> 
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="rol_id">Rol:</label>
        <select name="rol_id" id="rol_id" required>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ $rol->id == $user->rol_id ? 'selected' : '' }}>{{ $rol->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="tematica_id">Temática:</label>
        <select name="tematica_id" id="tematica_id" required>
            @foreach($tematicas as $tematica)
                <option value="{{ $tematica->id }}" {{ $tematica->id == $user->tematica_id ? 'selected' : '' }}>{{ $tematica->name }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="{{ route('users.index') }}">Regresar</a>
</body>
</html>
