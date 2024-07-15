<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Carrera</title>
 </head>
<body>
    <div class="container">
        <h1>Detalles de la Carrera</h1>
        <p><strong>Sigla:</strong> {{ $carrera->sigla }}</p>
        <p><strong>Descripción:</strong> {{ $carrera->descripcion }}</p>
        <p><strong>Gestión:</strong> {{ $carrera->gestion->descripcion }}</p>
        <a href="{{ route('carreras.index') }}" class="btn btn-primary">Volver</a>
    </div>
</body>
</html>
