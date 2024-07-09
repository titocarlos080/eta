<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Estudiante</title>
</head>
<body>
    <h1>Mostrar Estudiante</h1>
    <p>CI: {{ $estudiante->ci }}</p>
    <p>Nombre: {{ $estudiante->nombre }}</p>
    <p>Apellido Paterno: {{ $estudiante->apellido_pat }}</p>
    <p>Apellido Materno: {{ $estudiante->apellido_mat }}</p>
    <p>Email: {{ $estudiante->email }}</p>
    <p>Teléfono: {{ $estudiante->telefono }}</p>
    <p>Sexo: {{ $estudiante->sexo }}</p>
    <p>Fecha de Nacimiento: {{ $estudiante->fecha_nacimiento->format('d/m/Y') }}</p>
    <p>Usuario: {{ $estudiante->usuario->email }}</p>
    <a href="{{ route('estudiantes.index') }}">Regresar</a>
</body>
</html>
