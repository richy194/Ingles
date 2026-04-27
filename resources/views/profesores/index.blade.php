<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
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
                <h1>Gestion de Profesores</h1>
                <p>Centraliza datos docentes, importacion masiva y exportes operativos.</p>
            </div>
            <div class="actions">
                <a href="{{ route('dashboard') }}" class="btn btn-neutral">Regresar</a>
                <a href="{{ route('profesores.export') }}" class="btn btn-success">Exportar</a>
                @can('create', App\Models\Theacher::class)
                    <a href="{{ route('profesores.create') }}" class="btn btn-brand">Crear profesor</a>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <div class="toolbar">
                    <h2 class="card-title">Listado de profesores</h2>
                    <form action="{{ route('profesores.import') }}" method="POST" enctype="multipart/form-data" class="inline-row">
                        @csrf
                        <div class="file-picker">
                            <label class="file-picker-label">
                                <input type="file" name="file" accept=".xlsx,.csv" class="file-picker-input" required>
                                <span>Seleccionar archivo</span>
                            </label>
                            <span class="file-picker-name">Ningun archivo seleccionado</span>
                        </div>
                        <button class="btn btn-brand" type="submit">Importar archivo</button>
                    </form>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($profesores as $profesor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $profesor->nombre }}</td>
                                <td>{{ $profesor->email }}</td>
                                <td>{{ $profesor->Documento ?? 'No asignado' }}</td>
                                <td>{{ $profesor->telefono ?? 'No asignado' }}</td>
                                <td>{{ $profesor->direccion ?? 'No asignado' }}</td>
                                <td>
                                    <div class="actions-cell">
                                        @can('view', $profesor)
                                            <a href="{{ route('profesores.show', $profesor->id) }}" class="btn btn-info">Ver</a>
                                        @endcan
                                        @can('update', $profesor)
                                            <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        @can('delete', $profesor)
                                            <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('¿Eliminar este profesor?')">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">No hay profesores disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($profesores->hasPages())
                <div class="pager">{{ $profesores->onEachSide(1)->links() }}</div>
            @endif
            <p class="footer-note">Total profesores: {{ $profesores->total() }}</p>
        </section>
    </div>

    <script>
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
