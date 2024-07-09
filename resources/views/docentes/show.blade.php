<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Docente</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h1>Detalles del Docente</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>CI:</strong> {{ $docente->ci }}</p>
            <p><strong>Nombre:</strong> {{ $docente->nombre }}</p>
            <p><strong>Apellido Paterno:</strong> {{ $docente->apellido_pat }}</p>
            <p><strong>Apellido Materno:</strong> {{ $docente->apellido_mat }}</p>
            <p><strong>Email:</strong> {{ $docente->email }}</p>
            <p><strong>Kardex:</strong> {{ $docente->kardex }}</p>
            <p><strong>Curriculum:</strong> {{ $docente->curriculum }}</p>
            <p><strong>Usuario:</strong> {{ $docente->usuario->name }}</p>
            <a href="{{ route('docentes.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
