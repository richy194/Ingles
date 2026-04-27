<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Período Académico</title>
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
                <h1>Detalles del Período Académico</h1>
                <p>Información del período {{ $periodo->nombre }}.</p>
            </div>
            <div class="actions">
                <a href="{{ route('periodos.index') }}" class="btn btn-neutral">Volver</a>
                @can('update', $periodo)
                    <a href="{{ route('periodos.edit', $periodo) }}" class="btn btn-warning">Editar</a>
                @endcan
                @can('delete', $periodo)
                    <form action="{{ route('periodos.destroy', $periodo) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este período?')">Eliminar</button>
                    </form>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Año</label>
                        <div class="value">{{ $periodo->año }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Nombre</label>
                        <div class="value">{{ $periodo->nombre }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Tipo de Período</label>
                        <div class="value">{{ $periodo->periodo }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Descripción</label>
                        <div class="value">{{ $periodo->descripcion ?? 'No especificada' }}</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

