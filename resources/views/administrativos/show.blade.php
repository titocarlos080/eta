<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Administrativo</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h1>Detalles del Administrativo</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>CI:</strong> {{ $administrativo->ci }}</p>
            <p><strong>Nombre:</strong> {{ $administrativo->nombre }}</p>
            <p><strong>Apellido Paterno:</strong> {{ $administrativo->apellido_pat }}</p>
            <p><strong>Apellido Materno:</strong> {{ $administrativo->apellido_mat }}</p>
            <p><strong>Teléfono:</strong> {{ $administrativo->telefono }}</p>
            <p><strong>Email:</strong> {{ $administrativo->email }}</p>
            <p><strong>Sexo:</strong> {{ $administrativo->sexo }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $administrativo->fecha_nacimiento }}</p>
            <p><strong>Usuario:</strong> {{ $administrativo->usuario->name }}</p>
            <a href="{{ route('administrativos.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
