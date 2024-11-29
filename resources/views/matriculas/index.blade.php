<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrículas</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-header h1 {
            font-size: 1.8rem;
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-regresar {
            background-color: #28a745; /* Verde brillante */
        }

        .btn-regresar:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .acciones {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Gestión de Matrículas</h1>
            <div class="d-flex">
                <a href="/dashboard" class="btn btn-regresar">Regresar</a>
                @can('create', App\Models\Matricula::class)
                    <a href="{{ route('matriculas.create') }}" class="btn btn-primary ms-2">Crear matrícula</a>
                @endcan
            </div>
        </div>

        <!-- Tabla de Matrículas -->
        <h2>Lista de Matrículas</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Estudiante</th>
                        <th>Grupo</th>
                        <th>Profesor</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Nota</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriculas as $matricula)
                        <tr>
                            <td>{{ $matricula->id }}</td>
                            <td>{{ $matricula->student->nombre }}</td>
                            <td>{{ $matricula->curso->nombre ?? '-' }}</td>
                            <td>{{ $matricula->teacher->nombre ?? '-' }}</td>
                            <td>{{ $matricula->fecha_matricula }}</td>
                            <td>{{ $matricula->estado }}</td>
                            <td>{{ $matricula->nota_final }}</td>
                            <td class="acciones">
                                @can('view', $matricula)
                                    <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-primary">Ver</a>
                                @endcan
                                @can('update', $matricula)
                                    <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning">Editar</a>
                                @endcan
                                @can('delete', $matricula)
                                    <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
