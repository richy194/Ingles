<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Matrícula</title>
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
                <h1>Detalles de la Matrícula</h1>
                <p>Información completa del estudiante y su matrícula en el curso.</p>
            </div>
            <div class="actions">
                <a href="{{ route('matriculas.index') }}" class="btn btn-neutral">Volver</a>
                @can('update', $matricula)
                    <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning">Editar</a>
                @endcan
                @can('delete', $matricula)
                    <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta matrícula?')">Eliminar</button>
                    </form>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <div style="margin-bottom: 28px;">
                    <h2 style="margin: 0 0 16px; font-family: 'Sora', sans-serif; color: var(--ink-2); font-size: 1.2rem;">Información del Estudiante</h2>
                    <div class="details-grid">
                        <div class="detail-item">
                            <label>Nombre Completo</label>
                            <div class="value">{{ $matricula->student->nombre ?? 'No asignado' }}</div>
                        </div>
                        <div class="detail-item">
                            <label>Email</label>
                            <div class="value">{{ $matricula->student->email ?? 'No asignado' }}</div>
                        </div>
                        <div class="detail-item">
                            <label>Documento</label>
                            <div class="value">{{ $matricula->student->documento ?? 'No asignado' }}</div>
                        </div>
                        <div class="detail-item">
                            <label>Teléfono</label>
                            <div class="value">{{ $matricula->student->telefono ?? 'No asignado' }}</div>
                        </div>
                        <div class="detail-item">
                            <label>Dirección</label>
                            <div class="value">{{ $matricula->student->direccion ?? 'No asignado' }}</div>
                        </div>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid var(--line); margin: 28px 0;">

                <div style="margin-bottom: 28px;">
                    <h2 style="margin: 0 0 16px; font-family: 'Sora', sans-serif; color: var(--ink-2); font-size: 1.2rem;">Información de la Matrícula</h2>
                    <div class="details-grid">
                        <div class="detail-item">
                            <label>Curso</label>
                            <div class="value">{{ $matricula->curso->nombre ?? 'No asignado' }}</div>
                        </div>
                        <div class="detail-item">
                            <label>Profesor</label>
                            <div class="value">{{ $matricula->teacher->nombre ?? 'No asignado' }}</div>
                        </div>
                        <div class="detail-item">
                            <label>Fecha de Matrícula</label>
                            <div class="value">{{ $matricula->fecha_matricula ? \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') : 'No asignada' }}</div>
                        </div>
                        <div class="detail-item">
                            <label>Estado</label>
                            <div class="value">
                                @php
                                    $estadoClass = match($matricula->estado) {
                                        'aprobado', 'activo' => 'badge-success',
                                        'desaprobado', 'cancelado' => 'badge-danger',
                                        'no aprobado' => 'badge-warning',
                                        default => 'badge-soft'
                                    };
                                @endphp
                                <span class="badge {{ $estadoClass }}" style="text-transform: capitalize;">{{ $matricula->estado ?? 'Sin asignar' }}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <label>Nota Final</label>
                            <div class="value">
                                @if($matricula->nota_final)
                                    <strong>{{ number_format($matricula->nota_final, 2) }}/100</strong>
                                @else
                                    <em>No asignada</em>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid var(--line); margin: 28px 0;">

                <div class="form-actions">
                    <a href="{{ route('matriculas.index') }}" class="btn btn-neutral">Volver al Listado</a>
                    @can('update', $matricula)
                        <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-warning">Editar Matrícula</a>
                    @endcan
                </div>
            </div>
        </section>
    </div>
</body>
</html>
