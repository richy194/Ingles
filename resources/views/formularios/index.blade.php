<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios de Inscripcion</title>
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
                <h1>Formularios de Inscripcion</h1>
                <p>Supervisa solicitudes, estado academico y conversion a matricula desde un panel unificado.</p>
            </div>
            <div class="actions">
                <a href="{{ route('dashboard') }}" class="btn btn-neutral">Regresar</a>
                @can('create', App\Models\FormularioInscripcion::class)
                    <a href="{{ route('formularios.create') }}" class="btn btn-brand">Crear formulario</a>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h2 class="card-title">Listado de formularios</h2>
            </div>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Nota final</th>
                            <th>Curso</th>
                            <th>Profesor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($formularios as $formulario)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $formulario->name ?? 'No asignado' }}</td>
                                <td>{{ $formulario->email ?? 'No asignado' }}</td>
                                <td>{{ $formulario->documento ?? 'No asignado' }}</td>
                                <td>{{ $formulario->direccion ?? 'No asignado' }}</td>
                                <td>{{ $formulario->telefono ?? 'No asignado' }}</td>
                                <td>{{ $formulario->fecha_matricula ?? 'No asignado' }}</td>
                                <td><span class="badge badge-soft">{{ $formulario->estado ?? 'No asignado' }}</span></td>
                                <td>{{ $formulario->nota_final ?? 'No asignado' }}</td>
                                <td>{{ $formulario->curso->nombre ?? 'No asignado' }}</td>
                                <td>{{ $formulario->teacher->nombre ?? 'No asignado' }}</td>
                                <td>
                                    <div class="actions-cell">
                                        @can('view', $formulario)
                                            <a href="{{ route('formularios.show', $formulario->id) }}" class="btn btn-info">Ver</a>
                                        @endcan
                                        @can('update', $formulario)
                                            <a href="{{ route('formularios.edit', $formulario->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        @can('delete', $formulario)
                                            <form action="{{ route('formularios.destroy', $formulario->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta inscripcion?')">Eliminar</button>
                                            </form>
                                        @endcan
                                        @can('inscribir', $formulario)
                                            <form action="{{ route('formularios.inscribir', $formulario->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success" onclick="return confirm('¿Inscribir al estudiante?')">Inscribir</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="empty">No hay formularios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($formularios->hasPages())
                <div class="pager">{{ $formularios->onEachSide(1)->links() }}</div>
            @endif
            <p class="footer-note">Total formularios: {{ $formularios->total() }}</p>
        </section>
    </div>
</body>
</html>
