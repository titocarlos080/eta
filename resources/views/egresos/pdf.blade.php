<!DOCTYPE html>
<html>
<head>
    <title>Lista de Egresos</title>
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
    <h1>Lista de Egresos</h1>
    <table>
        <thead>
            <tr>
                <th>CONCEPTO</th>
                <th>MONTO</th>
                <th>FECHA</th>
                <th>GESTIÓN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($egresos as $egreso)
            <tr>
                <td>{{ $egreso->concepto }}</td>
                <td>{{ $egreso->monto }}</td>
                <td>{{ $egreso->fecha }}</td>
                <td>{{ $egreso->gestion->descripcion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
