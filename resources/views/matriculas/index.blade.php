<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrículas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> <!-- Si tienes un archivo custom.css -->
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

        /* Estilo personalizado para el botón de regresar */
        .btn-regresar {
            background-color: #28a745; /* Verde brillante */
            color: #fff; /* Texto blanco */
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-right: 10px; /* Espacio a la derecha */
        }

        .btn-regresar:hover {
            background-color: #218838; /* Verde más oscuro al pasar el mouse */
            transform: scale(1.05); /* Efecto de zoom */
            text-decoration: none; /* Elimina subrayado al pasar el mouse */
        }

        .btn-regresar:focus {
            outline: none; /* Elimina el borde de enfoque */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Matrículas</h3>
                <div class="d-flex">
                    <a href="/dashboard" class="btn btn-regresar">Regresar</a>

                    @can('create', App\Models\Matricula::class)
                        <a href="{{ route('matriculas.create') }}" class="btn btn-primary">Crear Matrícula</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estudiante</th>
                            <th>Curso</th>
                            <th>Profesor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matriculas as $matricula)
                            <tr>
                                <td>{{ $matricula->id }}</td>
                                <td>{{ $matricula->name }}</td>
                                <td>{{ $matricula->curso->nombre }}</td>
                                <td>{{ $matricula->teacher->nombre }}</td>
                                <td>{{ $matricula->estado }}</td>
                                <td>
                                    @can('view', $matricula)
                                        <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    @endcan
                                    @can('update', $matricula)
                                        <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    @endcan

                                    @can('delete', $matricula)
                                        <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
