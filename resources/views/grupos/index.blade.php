<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupos</title>
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
                <h1>Gestion de Grupos</h1>
                <p>Consulta asignaciones de curso, docente, cupos y horarios desde una vista ordenada.</p>
            </div>
            <div class="actions">
                <a href="{{ route('dashboard') }}" class="btn btn-neutral">Regresar</a>
                @can('create', App\Models\Group::class)
                    <a href="{{ route('grupos.create') }}" class="btn btn-brand">Crear grupo</a>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h2 class="card-title">Listado de grupos</h2>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Curso</th>
                            <th>Codigo curso</th>
                            <th>Grupo</th>
                            <th>Profesor</th>
                            <th>Cantidad</th>
                            <th>Horario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grupos as $group)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $group->curso->nombre ?? 'No asignado' }}</td>
                                <td><span class="badge badge-soft">{{ $group->curso->codigo ?? 'No asignado' }}</span></td>
                                <td>{{ $group->nombre ?? 'No asignado' }}</td>
                                <td>{{ $group->pofe->nombre ?? 'No asignado' }}</td>
                                <td>{{ $group->cantidad ?? 'No asignado' }}</td>
                                <td>
                                    @php($horarios = json_decode($group->horario))
                                    @if (!is_null($group->horario) && is_array($horarios))
                                        @foreach ($horarios as $horario)
                                            <div>{{ $horario->dia }}: {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</div>
                                        @endforeach
                                    @else
                                        No hay horarios
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-cell">
                                        @can('view', $group)
                                            <a href="{{ route('grupos.show', $group->id) }}" class="btn btn-info">Ver</a>
                                        @endcan
                                        @can('update', $group)
                                            <a href="{{ route('grupos.edit', $group->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        @can('delete', $group)
                                            <form action="{{ route('grupos.destroy', $group->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este grupo?')">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty">No hay grupos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($grupos->hasPages())
                <div class="pager">{{ $grupos->onEachSide(1)->links() }}</div>
            @endif
            <p class="footer-note">Total grupos: {{ $grupos->total() }}</p>
        </section>
    </div>
</body>
</html>
