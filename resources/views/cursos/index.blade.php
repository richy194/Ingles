<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
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
                <h1>Gestion de Cursos</h1>
                <p>Administra la oferta academica con una vista clara de niveles, periodos y modalidad.</p>
            </div>
            <div class="actions">
                <a href="{{ route('dashboard') }}" class="btn btn-neutral">Regresar</a>
                @can('create', App\Models\Curso::class)
                    <a href="{{ route('cursos.create') }}" class="btn btn-brand">Crear curso</a>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h2 class="card-title">Listado general</h2>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Nivel</th>
                            <th>Periodo</th>
                            <th>Modalidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $curso->nombre }}</td>
                                <td><span class="badge badge-soft">{{ $curso->codigo ?? 'No asignado' }}</span></td>
                                <td>{{ $curso->descripcion ?? 'No asignado' }}</td>
                                <td>{{ $curso->nivel_curso ?? 'No asignado' }}</td>
                                <td>{{ $curso->periodo->nombre ?? 'No asignado' }}</td>
                                <td>{{ $curso->modalidad ?? 'No asignado' }}</td>
                                <td>
                                    <div class="actions-cell">
                                        @can('view', $curso)
                                            <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-info">Ver</a>
                                        @endcan
                                        @can('update', $curso)
                                            <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        @can('delete', $curso)
                                            <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('¿Eliminar este curso?')">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty">No hay cursos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($cursos->hasPages())
                <div class="pager">{{ $cursos->onEachSide(1)->links() }}</div>
            @endif
            <p class="footer-note">Total cursos: {{ $cursos->total() }}</p>
        </section>
    </div>
</body>
</html>
