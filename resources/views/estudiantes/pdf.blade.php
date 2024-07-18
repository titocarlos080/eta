<!DOCTYPE html>
<html>
<head>
    <title>Lista de Estudiantes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Lista de Estudiantes</h1>
    <table>
        <thead>
            <tr>
                <th>CI</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Email</th>
                <th>Sexo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->ci }}</td>
                <td>{{ $estudiante->nombre }}</td>
                <td>{{ $estudiante->apellido_pat }}</td>
                <td>{{ $estudiante->email }}</td>
                <td>{{ $estudiante->sexo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
