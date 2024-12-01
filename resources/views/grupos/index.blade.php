<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Grupos</title>
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
                <h3>Lista de Grupos</h3>
                <!-- Botones "Regresar" y "Crear Grupo" juntos en la misma fila -->
                <div class="d-flex">
                    <a href="/dashboard" class="btn btn-regresar">Regresar</a>
                    @can('create', App\Models\Group::class)
                        <a href="{{ route('grupos.create') }}" class="btn btn-primary">Crear Grupo</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>nombre curso</th>
                            <th>codigo curso</th>
                            <th>Periodo</th>
                            <th>Cantidad</th>
                            <th>Docente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grupos as $group)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $group->codigo }}</td>
                                <td>{{ $group->curso->nombre ?? 'No disponible' }}</td>
                                <td>{{ $group->curso->codigo ?? 'No disponible' }}</td>
                                <td>{{ $group->periodo_academicos->nombre ?? 'No disponible' }}</td>
                                <td>{{ $group->cantidad }}</td>
                                <td>{{ $group->pofe->nombre }}</td>
                                <td>
                                    @can('view', $group)
                                        <a href="{{ route('grupos.show', $group->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    @endcan
                                    @can('update', $group)
                                        <a href="{{ route('grupos.edit', $group->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    @endcan
                                    @can('delete', $group)
                                        <form action="{{ route('grupos.destroy', $group->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este grupo?')">Eliminar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay grupos disponibles</td>
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
