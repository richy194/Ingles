<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Grupo</title>
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
        .form-group label {
            font-weight: bold;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Detalles del Grupo</h1>
        <p><strong>Código:</strong> {{ $grupo->codigo }}</p>
        <p><strong>Curso:</strong> {{ $grupo->curso->nombre }}</p>
        <p><strong>Periodo Académico:</strong> {{ $grupo->periodo_academicos->nombre }}</p>
        <p><strong>Cantidad:</strong> {{ $grupo->cantidad }}</p>
        <p><strong>Docente:</strong> {{ $grupo->docente }}</p>
        <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>
