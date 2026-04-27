<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriculas</title>
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
                <h1>Gestion de Matriculas</h1>
                <p>Controla importaciones, busquedas y acciones por lote en un flujo profesional y robusto.</p>
            </div>
            <div class="actions">
                <a href="{{ route('dashboard') }}" class="btn btn-neutral">Regresar</a>
                <a href="{{ route('matriculas.export') }}" class="btn btn-success">Exportar</a>
                @can('create', App\Models\Matricula::class)
                    <a href="{{ route('matriculas.create') }}" class="btn btn-brand">Crear matricula</a>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <div class="toolbar">
                    <h2 class="card-title">Listado de matriculas</h2>
                    <form action="{{ route('matriculas.import') }}" method="POST" enctype="multipart/form-data" class="inline-row">
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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('info'))
                <div class="alert alert-warning">{{ session('info') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('failures'))
                <div class="alert alert-warning">
                    <strong>Algunos registros no se pudieron importar:</strong>
                    <ul>
                        @foreach (session('failures') as $failure)
                            <li>Fila {{ $failure->row() }}: {{ $failure->errors()[0] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-header">
                <div class="toolbar">
                    <form action="{{ route('matriculas.index') }}" method="GET" class="search">
                        <input class="input" type="text" name="query" placeholder="Buscar por nombre o documento" value="{{ request('query') }}">
                        <button type="submit" class="btn btn-neutral">Buscar</button>
                    </form>

                    <form id="bulk-delete-matriculas" action="{{ route('matriculas.destroyMultiple') }}" method="POST" class="inline-row">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar las matriculas seleccionadas?')">Eliminar seleccionados</button>
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
                            <th>Documento</th>
                            <th>Fecha matricula</th>
                            <th>Curso</th>
                            <th>Nota final</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($matriculas as $matricula)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $matricula->id }}" form="bulk-delete-matriculas"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $matricula->student->nombre ?? 'No asignado' }}</td>
                                <td>{{ $matricula->student->documento ?? 'No asignado' }}</td>
                                <td>{{ $matricula->fecha_matricula ?? 'No asignado' }}</td>
                                <td>{{ $matricula->curso->nombre ?? 'No asignado' }}</td>
                                <td>{{ $matricula->nota_final ?? 'No asignado' }}</td>
                                <td>
                                    <div class="actions-cell">
                                        @can('view', $matricula)
                                            <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-info">Ver</a>
                                        @endcan
                                        @can('update', $matricula)
                                            <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        @can('delete', $matricula)
                                            <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta matricula?')">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty">No hay matriculas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @include('components.pager', ['paginator' => $matriculas])
            <p class="footer-note">Total matriculas: {{ $matriculas->total() }}</p>
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


