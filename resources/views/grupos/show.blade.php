<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Grupo</title>
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
            background-color: #a8e6cf;
            color: #fff;
        }
        .btn:hover {
            background-color: #80e0bb;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Detalles del Grupo</h3>
            </div>
            <div class="card-body">
                <p><strong>Código:</strong> {{ $grupo->codigo }}</p>
                <p><strong>Curso:</strong> {{ $grupo->curso->nombre }}</p>
                <p><strong>Periodo Académico:</strong> {{ $grupo->periodo_academicos->nombre }}</p>
                <p><strong>Cantidad:</strong> {{ $grupo->cantidad }}</p>
                <p><strong>Docente:</strong> {{ $grupo->pofe->nombre }}</p>

                <a href="{{ route('grupos.index') }}" class="btn">Volver a la lista</a>
            </div>
        </div>
    </div>
</body>
</html>
