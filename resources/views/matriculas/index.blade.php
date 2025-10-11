<!DOCTYPE html>
<html lang="es">
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
        .card-header h1 {
            font-size: 1.8rem;
            margin: 0;
        }
        .custom-file-input {
            position: relative;
            width: 100%;
            height: 50px;
            margin-bottom: 15px;
            background-color: #f9f9f7;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            color: #4CAF50;
            transition: all 0.3s ease-in-out;
        }
        .custom-file-input:hover {
            background-color: #e8f5e9;
            border-color: #388E3C;
            color: #388E3C;
        }
        .custom-file-input input[type="file"] {
            opacity: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-weight: bold;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn-regresar { background-color: #28a745; }
        .btn-regresar:hover { background-color: #218838; }
        .btn-primary { background-color: #007bff; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-warning { background-color: #ffc107; color: #000; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; }
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
            position: sticky;
            top: 0;
            z-index: 2;
        }
        .acciones { display: flex; gap: 5px; justify-content: center; }
        .search-form {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }
        .search-form input {
            flex: 1;
            min-width: 200px;
            padding: 8px 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .search-form button {
            padding: 8px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
        }
        .search-form button:hover { background-color: #0056b3; }

        /* Estilos de alertas */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            position: relative;
            animation: fadeIn 0.4s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-warning { background: #fff3cd; color: #856404; border: 1px solid #ffeeba; }

        .alert button.close {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            color: inherit;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Listado de Matrículas</h1>

            <div class="d-flex">
                <form action="{{ route('matriculas.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="custom-file-input">
                        <input type="file" name="file" required onchange="mostrarNombreArchivo(this)">
                        <span class="btn btn-regresar">Seleccionar archivo</span>
                    </label>
                    <p id="nombre-archivo" style="font-size:14px; color:#555;"></p>
                    <button class="btn btn-primary"><i class="fa fa-file"></i> Importar</button>
                </form>

                <a href="/dashboard" class="btn btn-warning">Regresar</a>
                <a href="{{ route('matriculas.export') }}" class="btn btn-success">Exportar</a>

                @can('create', App\Models\Matricula::class)
                    <a href="{{ route('matriculas.create') }}" class="btn btn-primary ms-2">Crear matrícula</a>
                @endcan
            </div>
        </div>

        {{-- ✅ Mensajes de estado del import --}}
        @if(session('success'))
            <div class="alert alert-success">
                <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
                <strong>✅ {{ session('success') }}</strong>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-warning">
                <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
                <i class="fa fa-info-circle"></i> {{ session('info') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
                <strong>❌ {{ session('error') }}</strong>
            </div>
        @endif

        @if(session('failures'))
            <div class="alert alert-warning">
                <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
                <strong>⚠️ Algunos registros no se pudieron importar:</strong>
                <ul>
                    @foreach (session('failures') as $failure)
                        <li>
                            <strong>Fila {{ $failure->row() }}:</strong>
                            {{ $failure->errors()[0] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Buscador --}}
        <form action="{{ route('matriculas.index') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Buscar por nombre o documento" value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        {{-- Tabla --}}
        <form action="{{ route('matriculas.destroyMultiple') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Fecha matrícula</th>
                            <th>Curso</th>
                            <th>Profesor</th>
                            <th>Estado</th>
                            <th>Nota final</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matriculas as $matricula)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $matricula->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $matricula->student->nombre ?? 'No asignado' }}</td>
                                <td>{{ $matricula->student->documento ?? 'No asignado' }}</td>
                                <td>{{ $matricula->fecha_matricula }}</td>
                                <td>{{ $matricula->curso->nombre ?? 'No asignado' }}</td>
                                <td>{{ $matricula->teacher->nombre ?? 'No asignado' }}</td>
                                <td>{{ $matricula->estado ?? 'No asignado' }}</td>
                                <td>{{ $matricula->nota_final ?? 'No asignado' }}</td>
                                <td class="acciones">
                                    @can('view', $matricula)
                                        <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-primary">Ver</a>
                                    @endcan
                                    @can('update', $matricula)
                                        <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning">Editar</a>
                                    @endcan
                                    @can('delete', $matricula)
                                        <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta matrícula?')">Eliminar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar seleccionados</button>
        </form>
    </div>
</div>

<script>
    // Seleccionar todos los checkboxes
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    // Mostrar nombre del archivo seleccionado
    function mostrarNombreArchivo(input) {
        const fileName = input.files[0]?.name || "Ningún archivo seleccionado";
        document.getElementById('nombre-archivo').textContent = "Archivo: " + fileName;
    }

    // Cerrar automáticamente las alertas después de 6 segundos
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        });
    }, 6000);
</script>
</body>
</html>


