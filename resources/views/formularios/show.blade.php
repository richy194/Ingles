<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Formulario</title>
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
                <h1>Detalles de Inscripción</h1>
                <p>Información de {{ $formulario->name }}.</p>
            </div>
            <div class="actions">
                <a href="{{ route('formularios.index') }}" class="btn btn-neutral">Volver</a>
                @can('update', $formulario)
                    <a href="{{ route('formularios.edit', $formulario) }}" class="btn btn-warning">Editar</a>
                @endcan
                @can('delete', $formulario)
                    <form action="{{ route('formularios.destroy', $formulario) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta inscripción?')">Eliminar</button>
                    </form>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Nombre</label>
                        <div class="value">{{ $formulario->name }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Correo Electrónico</label>
                        <div class="value">{{ $formulario->email }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Documento</label>
                        <div class="value">{{ $formulario->documento }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Dirección</label>
                        <div class="value">{{ $formulario->direccion ?? 'No especificada' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Teléfono</label>
                        <div class="value">{{ $formulario->telefono ?? 'No especificado' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Fecha de Matrícula</label>
                        <div class="value">{{ $formulario->fecha_matricula }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Estado</label>
                        <div class="value">
                            <span class="badge badge-{{ $formulario->estado == 'aprobado' ? 'success' : ($formulario->estado == 'desaprobado' ? 'danger' : 'warning') }}">{{ $formulario->estado }}</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <label>Nota Final</label>
                        <div class="value">{{ $formulario->nota_final ?? 'No asignada' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Curso</label>
                        <div class="value">{{ $formulario->curso->nombre ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Profesor</label>
                        <div class="value">{{ $formulario->teacher->nombre ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
