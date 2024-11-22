<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Matrícula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Detalles de Matrícula</h1>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $matricula->id }}</td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td>{{ $matricula->name }}</td>
            </tr>
            <tr>
                <th>Correo</th>
                <td>{{ $matricula->email }}</td>
            </tr>
            <tr>
                <th>Curso</th>
                <td>{{ $matricula->curso->name }}</td>
            </tr>
            <tr>
                <th>Profesor</th>
                <td>{{ $matricula->teacher->name }}</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ $matricula->estado }}</td>
            </tr>
        </table>

        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>
