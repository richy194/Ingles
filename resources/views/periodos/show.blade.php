<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Periodo Académico</title>
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
                <h3>Detalles del Periodo Académico</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Año:</strong> {{ $periodo->año }}</li>
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $periodo->nombre }}</li>
                    <li class="list-group-item"><strong>Periodo:</strong> {{ $periodo->periodo }}</li>
                    <li class="list-group-item"><strong>Descripción:</strong> {{ $periodo->descripcion }}</li>
                </ul>
                <a href="{{ route('periodos.index') }}" class="btn btn-secondary">Volver al Listado</a>
            </div>
        </div>
    </div>
</body>
</html>

