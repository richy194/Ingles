<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Estudiante</title>
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
                <h1>Detalles del Estudiante</h1>
                <p>Información completa del perfil y datos del estudiante.</p>
            </div>
            <div class="actions">
                <a href="{{ route('estudiantes.index') }}" class="btn btn-neutral">Volver</a>
                @can('update', $estudiante)
                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning">Editar</a>
                @endcan
                @can('delete', $estudiante)
                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este estudiante?')">Eliminar</button>
                    </form>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <h2 style="margin: 0 0 20px; font-family: 'Sora', sans-serif; color: var(--ink-2); font-size: 1.2rem;">Información Personal</h2>
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Nombre Completo</label>
                        <div class="value">{{ $estudiante->nombre ?? 'No asignado' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Email</label>
                        <div class="value">{{ $estudiante->email ?? 'No asignado' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Documento</label>
                        <div class="value">{{ $estudiante->documento ?? 'No asignado' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Teléfono</label>
                        <div class="value">{{ $estudiante->telefono ?? 'No asignado' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Dirección</label>
                        <div class="value">{{ $estudiante->direccion ?? 'No asignado' }}</div>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid var(--line); margin: 28px 0;">

                <div class="form-actions">
                    <a href="{{ route('estudiantes.index') }}" class="btn btn-neutral">Volver al Listado</a>
                    @can('update', $estudiante)
                        <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning">Editar Estudiante</a>
                    @endcan
                </div>
            </div>
        </section>
    </div>
</body>
</html>
