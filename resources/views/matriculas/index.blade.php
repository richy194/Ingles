<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Matrículas</title>
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

        .btn-regresar, .btn-importar, .btn-exportar {
            background-color: #28a745; /* Verde brillante */
            color: #fff;
            border: none;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-regresar:hover, .btn-importar:hover, .btn-exportar:hover , btn btn-primary ms-2:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-regresar:focus, .btn-importar:focus, .btn-exportar:focus {
            outline: none;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .form-import {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 20px;
        }

        .form-import input[type="file"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
        }

        .form-import button {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            padding: 8px 16px;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        .form-import button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Lista de Matrículas</h3>
                <div class="d-flex">
                    <a href="/dashboard" class="btn btn-regresar">Regresar</a>
                    <div class="form-import">
                        <form action="{{ route('matriculas.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control" required>
                            <button type="submit" class="btn btn-importar">Importar Excel</button>
                        </form>
                    </div>
                    <a href="{{ route('matriculas.export') }}" class="btn btn-success ms-2 btn-exportar">Exportar Excel</a>
                    @can('create', App\Models\Matricula::class)
                        <a href="{{ route('matriculas.create') }}" class="btn btn-primary ms-2">Crear Matrícula</a>
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
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Nota</th>
                                <th>Curso</th>
                                <th>Profesor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matriculas as $matricula)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $matricula->name }}</td>
                                    <td>{{ $matricula->email }}</td>
                                    <td>{{ $matricula->Documento }}</td>
                                    <td>{{ $matricula->direccion }}</td>
                                    <td>{{ $matricula->telefono }}</td>
                                    <td class="text-center">{{ $matricula->fecha_matricula }}</td>
                                    <td class="text-center">{{ $matricula->estado }}</td>
                                    <td class="text-center">{{ $matricula->nota_final }}</td>
                                    <td>{{ $matricula->curso->nombre }}</td>
                                    <td>{{ $matricula->teacher->nombre }}</td>
                                    <td class="acciones">
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
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta matrícula?')">Eliminar</button>
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
