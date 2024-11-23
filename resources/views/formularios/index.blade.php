<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Formularios de Inscripción</title>
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
                <h3>Lista de Formularios de Inscripción</h3>
                <div class="d-flex">
                    <a href="/dashboard" class="btn btn-regresar">Regresar</a>
                    @can('create', App\Models\FormularioInscripcion::class)
                        <a href="{{ route('formularios.create') }}" class="btn btn-primary ms-2">Crear Formulario</a>
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
                                <th>Fecha de Matrícula</th>
                                <th>Estado</th>
                                <th>nota final</th>
                                 <th>Curso</th>
                                <th>Profesor</th>      
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formularios as $formulario)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $formulario->name }}</td>  <!-- Nombre del estudiante -->
                                    <td>{{ $formulario->email }}</td> <!-- Email -->
                                    <td>{{ $formulario->Documento }}</td> <!-- Documento -->
                                    <td>{{ $formulario->direccion }}</td> <!-- Dirección -->
                                    <td>{{ $formulario->telefono }}</td> <!-- Teléfono -->
                                    <td class="text-center">{{ $formulario->fecha_matricula }}</td> 
                                    <td class="text-center">{{ $formulario->estado }}</td> 
                                    <td class="text-center">{{ $formulario->nota_final }}</td> 
                                    <td>{{ $formulario->curso->nombre ?? 'Sin curso' }}</td> 
                                    <td>{{ $formulario->teacher->nombre ?? 'Sin pofee' }}</td>
                                    <td class="acciones">
                                        @can('view', $formulario)
                                            <a href="{{ route('formularios.show', $formulario->id) }}" class="btn btn-info btn-sm">Ver</a>
                                        @endcan
                                        @can('update', $formulario)
                                            <a href="{{ route('formularios.edit', $formulario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        @endcan
                                        @can('delete', $formulario)
                                            <form action="{{ route('formularios.destroy', $formulario->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta inscripción?')">Eliminar</button>
                                            </form>
                                        @endcan
                                        @can('inscribir', $formulario)
                                            <form action="{{ route('formularios.inscribir', $formulario->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('¿Inscribir al estudiante?')">Inscribir</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
