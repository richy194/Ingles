<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
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
                <h3>Lista de Cursos</h3>
                <!-- Botones "Regresar" y "Crear Curso" juntos en la misma fila -->
                <div class="d-flex">
                    <a href="/dashboard" class="btn btn-regresar">Regresar</a>
                    @can('create', App\Models\Curso::class)
                        <a href="{{ route('cursos.create') }}" class="btn btn-primary">Crear Curso</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $curso->nombre }}</td>
                                <td>{{ $curso->codigo }}</td>
                                <td>{{ $curso->descripcion }}</td>
                                <td>
                                    @can('view', $curso)
                                        <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    @endcan
                                    @can('update', $curso)
                                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    @endcan
                                    @can('delete', $curso)
                                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este curso?')">Eliminar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay cursos disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
