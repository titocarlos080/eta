<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Usuario</title>
</head>
<body>
    <h1>Mostrar Usuario</h1>
    <p>Nombre: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Rol: {{ $user->rol->nombre }}</p>
    <p>Temática: {{ $user->tematica->nombre }}</p>
    <a href="{{ route('users.index') }}">Regresar</a>
</body>
</html>
