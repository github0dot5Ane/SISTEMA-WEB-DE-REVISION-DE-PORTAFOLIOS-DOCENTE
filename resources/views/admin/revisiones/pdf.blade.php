<!DOCTYPE html>
<html>
<head>
    <title>Informe de Portafolios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Informe de Portafolios</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre del Docente</th>
                <th>Curso</th>
                <th>Nombre del Revisor</th>
                <th>Resultado</th>
                <th>Comentarios</th>
                <th>Última Actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portafoliosConDatos as $portafolio)
                <tr>
                    <td>{{ $portafolio['nombre_docente'] }}</td>
                    <td>{{ $portafolio['curso'] }}</td>
                    <td>{{ $portafolio['nombre_revisor'] }}</td>
                    <td>{{ $portafolio['resultado'] }}</td>
                    <td>{{ $portafolio['comentarios'] }}</td>
                    <td>{{ $portafolio['updated_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
