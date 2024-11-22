<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }
        .card {
            margin-top: 50px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Detalles del Curso</h3>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $curso->nombre }}</p>
                <p><strong>Código:</strong> {{ $curso->codigo }}</p>
                <p><strong>Descripción:</strong> {{ $curso->descripcion }}</p>
                <p><strong>Nivel:</strong> {{ $curso->nivel_curso }}</p>
                <p><strong>Fecha de Inicio:</strong> {{ $curso->fecha_inicio }}</p>
                <p><strong>Fecha de Fin:</strong> {{ $curso->fecha_fin }}</p>
                <p><strong>Requisitos:</strong> {{ $curso->requisito }}</p>
                <p><strong>Modalidad:</strong> {{ $curso->modalidad }}</p>

                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

