<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Grupo</title>
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
                <h1>Detalles del Grupo</h1>
                <p>Información sobre el grupo {{ $grupo->nombre }}.</p>
            </div>
            <div class="actions">
                <a href="{{ route('grupos.index') }}" class="btn btn-neutral">Volver</a>
                @can('update', $grupo)
                    <a href="{{ route('grupos.edit', $grupo) }}" class="btn btn-warning">Editar</a>
                @endcan
                @can('delete', $grupo)
                    <form action="{{ route('grupos.destroy', $grupo) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este grupo?')">Eliminar</button>
                    </form>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Curso</label>
                        <div class="value">{{ $grupo->curso->nombre }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Código del Curso</label>
                        <div class="value">{{ $grupo->curso->codigo }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Nombre del Grupo</label>
                        <div class="value">{{ $grupo->nombre }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Período Académico</label>
                        <div class="value">{{ $grupo->periodo_academicos->nombre }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Profesor</label>
                        <div class="value">{{ $grupo->pofe->nombre }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Cantidad de Estudiantes</label>
                        <div class="value">{{ $grupo->cantidad }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Horario</label>
                        <div class="value">{{ $grupo->horario ?? 'No especificado' }}</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

