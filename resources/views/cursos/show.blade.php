<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }
        .card {
            margin-top: 50px;
        }
        .btn {
            margin-top: 10px;
            background-color: #a8e6cf;
            color: #fff;
        }
        .btn:hover {
            background-color: #80e0bb;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Detalles del Curso</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $curso->nombre }}</li>
                    <li class="list-group-item"><strong>Código del curso:</strong> {{ $curso->codigo?? 'No asignado'   }}</li>
                    <li class="list-group-item"><strong>Descripción:</strong> {{ $curso->descripcion }}</li>
                    <li class="list-group-item"><strong>Nivel:</strong> {{ $curso->nivel_curso }}</li>
                    <li class="list-group-item"><strong>Grupos:</strong>
                        @if($curso->grupos->isNotEmpty())
                            {{ $curso->grupos->pluck('nombre')->join(', ') }}
                        @else
                            No asignado
                        @endif
                    </li>
                    <li class="list-group-item"><strong>Periodo:</strong> {{ $curso->periodo->nombre?? 'No asignado'   }}</li>
                    <li class="list-group-item"><strong>Requisitos:</strong> 
                        @if($curso->requisito)
                            {{ $curso->requisito?? 'No asignado'   }}
                        @else
                            No especificado
                        @endif
                    </li>
                    <li class="list-group-item"><strong>Modalidad:</strong> {{ $curso->modalidad?? 'No asignado'   }}</li>
                    <ul class="list-group">
                    @foreach ($curso->grupos as $grupo)
                    <li class="list-group-item">
                    <strong>Profesor:</strong> {{ $grupo->pofe ? $grupo->pofe->nombre : 'Sin asignar' }}
                   </li>
                   @endforeach
                    </ul>
                
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Curso</title>
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
                <h1>Detalles del Curso</h1>
                <p>Información completa del curso y configuración.</p>
            </div>
            <div class="actions">
                <a href="{{ route('cursos.index') }}" class="btn btn-neutral">Volver</a>
                @can('update', $curso)
                    <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning">Editar</a>
                @endcan
                @can('delete', $curso)
                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este curso?')">Eliminar</button>
                    </form>
                @endcan
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <h2 style="margin: 0 0 20px; font-family: 'Sora', sans-serif; color: var(--ink-2); font-size: 1.2rem;">Información General</h2>
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Nombre del Curso</label>
                        <div class="value">{{ $curso->nombre }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Código</label>
                        <div class="value">{{ $curso->codigo ?? 'No asignado' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Nivel</label>
                        <div class="value">{{ $curso->nivel_curso }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Modalidad</label>
                        <div class="value">{{ $curso->modalidad ?? 'No asignado' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Descripción</label>
                        <div class="value">{{ $curso->descripcion }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Período</label>
                        <div class="value">{{ $curso->periodo->nombre ?? 'No asignado' }}</div>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid var(--line); margin: 28px 0;">

                <div class="form-actions">
                    <a href="{{ route('cursos.index') }}" class="btn btn-neutral">Volver al Listado</a>
                    @can('update', $curso)
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning">Editar Curso</a>
                    @endcan
                </div>
            </div>
        </section>
    </div>
</body>
</html>
            </div>
        </div>
    </div>
</body>
</html>
