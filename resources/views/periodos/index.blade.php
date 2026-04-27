<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodos Academicos</title>
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
                <h1>Periodos Academicos</h1>
                <p>Controla semestres y ciclos con una gestion clara de fechas, descripcion y etapa activa.</p>
            </div>
            <div class="actions">
                <a href="{{ route('dashboard') }}" class="btn btn-neutral">Regresar</a>
                @can('create', App\Models\PeriodoAcademico::class)
                    <a href="{{ route('periodos.create') }}" class="btn btn-brand">Crear periodo</a>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h2 class="card-title">Listado de periodos</h2>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ano</th>
                            <th>Nombre</th>
                            <th>Periodo</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($periodos as $periodo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-soft">{{ $periodo->año }}</span></td>
                                <td>{{ $periodo->nombre }}</td>
                                <td>{{ $periodo->periodo }}</td>
                                <td>{{ $periodo->descripcion ?? 'Sin descripcion' }}</td>
                                <td>
                                    <div class="actions-cell">
                                        @can('view', $periodo)
                                            <a href="{{ route('periodos.show', $periodo->id) }}" class="btn btn-info">Ver</a>
                                        @endcan
                                        @can('update', $periodo)
                                            <a href="{{ route('periodos.edit', $periodo->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        @can('delete', $periodo)
                                            <form action="{{ route('periodos.destroy', $periodo->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('¿Eliminar este periodo?')">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">No hay periodos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($periodos->hasPages())
                <div class="pager">{{ $periodos->onEachSide(1)->links() }}</div>
            @endif
            <p class="footer-note">Total periodos: {{ $periodos->total() }}</p>
        </section>
    </div>
</body>
</html>
