<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Profesores</title>
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
            margin-bottom: 10px;
        }

        .custom-file-input {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-right: 10px;
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
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
            margin-right: 10px;
        }

        .btn-regresar {
            background-color: #28a745;
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

        .table th, .table td {
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

        .acciones form {
            display: inline;
        }

        .botones-top {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Listado de Profesores</h1>

            <form action="{{ route('profesores.import') }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 15px;">
                @csrf
                <label class="custom-file-input btn btn-regresar">
                    Seleccionar archivo
                    <input type="file" name="file">
                </label>
                <button class="btn btn-primary" type="submit"><i class="fa fa-file"></i> Importar</button>
            </form>

            <div class="botones-top">
                <a href="{{ route('matriculas.export') }}" class="btn btn-regresar">Exportar</a>
                <a href="/dashboard" class="btn btn-regresar">Regresar</a>

                @can('create', App\Models\Theacher::class)
                    <a href="{{ route('matriculas.create') }}" class="btn btn-primary">Crear Profesor</a>
                @endcan
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Documento</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profesores as $profesor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $profesor->nombre }}</td>
                            <td>{{ $profesor->email }}</td>
                            <td>{{ $profesor->Documento }}</td>
                            <td>{{ $profesor->telefono }}</td>
                            <td>{{ $profesor->direccion }}</td>
                            <td class="acciones">
                                @can('view', $profesor)
                                    <a href="{{ route('profesores.show', $profesor->id) }}" class="btn btn-regresar">Ver</a>
                                @endcan
                                @can('update', $profesor)
                                    <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-warning">Editar</a>
                                @endcan
                                @can('delete', $profesor)
                                    <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este profesor?')">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No hay profesores disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
