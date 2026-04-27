<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <link rel="icon" type="image/png" href="{{ asset('img/uteis.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&family=Sora:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modern-admin.css') }}">
</head>
<body>
    <div class="page-shell">
        <section class="hero">
            <div>
                <h1>Gestion de Estudiantes</h1>
                <p>Administra perfiles estudiantiles, busqueda operativa e importacion masiva de datos.</p>
            </div>
            <div class="actions">
                <a href="{{ route('dashboard') }}" class="btn btn-neutral">Regresar</a>
                <a href="{{ route('estudiantes.export') }}" class="btn btn-success">Exportar</a>
                @can('create', App\Models\Student::class)
                    <a href="{{ route('estudiantes.create') }}" class="btn btn-brand">Crear estudiante</a>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <div class="toolbar">
                    <h2 class="card-title">Listado de estudiantes</h2>
                    <form action="{{ route('estudiantes.import') }}" method="POST" enctype="multipart/form-data" class="inline-row">
                        @csrf
                        <div class="file-picker">
                            <label class="file-picker-label">
                                <input type="file" name="file" accept=".xlsx,.csv" class="file-picker-input" required>
                                <span>Seleccionar archivo</span>
                            </label>
                            <span class="file-picker-name">Ningun archivo seleccionado</span>
                        </div>
                        <button type="submit" class="btn btn-brand">Importar archivo</button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Errores encontrados:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-header">
                <div class="toolbar">
                    <form action="{{ route('estudiantes.index') }}" method="GET" class="search">
                        <input class="input" type="text" name="query" placeholder="Buscar por nombre o documento" value="{{ request('query') }}">
                        <button type="submit" class="btn btn-neutral">Buscar</button>
                    </form>

                    <form id="bulk-delete-estudiantes" action="{{ route('estudiantes.destroyMultiple') }}" method="POST" class="inline-row">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar los estudiantes seleccionados?')">Eliminar seleccionados</button>
                    </form>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($estudiantes as $estudiante)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $estudiante->id }}" form="bulk-delete-estudiantes"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $estudiante->nombre }}</td>
                                <td>{{ $estudiante->email }}</td>
                                <td>{{ $estudiante->documento ?? 'No asignado' }}</td>
                                <td>{{ $estudiante->direccion ?? 'No asignado' }}</td>
                                <td>{{ $estudiante->telefono ?? 'No asignado' }}</td>
                                <td>
                                    <div class="actions-cell">
                                        @can('view', $estudiante)
                                            <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="btn btn-info">Ver</a>
                                        @endcan
                                        @can('update', $estudiante)
                                            <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        @can('delete', $estudiante)
                                            <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este estudiante?')">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty">No hay estudiantes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @include('components.pager', ['paginator' => $estudiantes])
            <p class="footer-note">Total estudiantes: {{ $estudiantes->total() }}</p>
        </section>
    </div>

    <script>
        const selectAll = document.getElementById('select-all');
        if (selectAll) {
            selectAll.addEventListener('change', function () {
                document.querySelectorAll('input[name="ids[]"]').forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
            });
        }

        document.querySelectorAll('.file-picker').forEach((picker) => {
            const input = picker.querySelector('.file-picker-input');
            const name = picker.querySelector('.file-picker-name');
            if (!input || !name) {
                return;
            }

            input.addEventListener('change', function () {
                name.textContent = this.files && this.files.length ? this.files[0].name : 'Ningun archivo seleccionado';
            });
        });
    </script>
</body>
</html>



