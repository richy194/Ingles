<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }

        .card {
            margin-top: 30px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table th {
            text-align: center;
            background-color: #f1f1f1;
        }

        .acciones {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .btn-regresar {
            background-color: #28a745; /* Verde brillante */
            color: #fff;
            border: none;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-regresar:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-regresar:focus {
            outline: none;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Lista de Profesores</h3>
            <div class="d-flex">
                <a href="/dashboard" class="btn btn-regresar">Regresar</a>
                @can('create', App\Models\Theacher::class)
                    <a href="{{ route('profesores.create') }}" class="btn btn-primary ms-2">Crear Profesor</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>direccion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesores as $profesor)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $profesor->nombre }}</td>
                                <td>{{ $profesor->email }}</td>
                                <td>{{ $profesor->Documento }}</td>
                                <td>{{ $profesor->telefono }}</td>
                                <td>{{ $profesor->direccion }}</td>
                                <td class="acciones">
                                    @can('view', $profesor)
                                        <a href="{{ route('profesores.show', $profesor->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    @endcan
                                    @can('update', $profesor)
                                        <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    @endcan
                                    @can('delete', $profesor)
                                        <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este profesor?')">Eliminar</button>
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
</div>
</body>
</html>
