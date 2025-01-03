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
                    <li class="list-group-item"><strong>Código del curso:</strong> {{ $curso->codigo }}</li>
                    <li class="list-group-item"><strong>Descripción:</strong> {{ $curso->descripcion }}</li>
                    <li class="list-group-item"><strong>Nivel:</strong> {{ $curso->nivel_curso }}</li>
                    <li class="list-group-item"><strong>Grupos:</strong>
                        @if($curso->grupos->isNotEmpty())
                            {{ $curso->grupos->pluck('nombre')->join(', ') }}
                        @else
                            No asignado
                        @endif
                    </li>
                    <li class="list-group-item"><strong>Periodo:</strong> {{ $curso->periodo->nombre }}</li>
                    <li class="list-group-item"><strong>Requisitos:</strong> 
                        @if($curso->requisito)
                            {{ $curso->requisito }}
                        @else
                            No especificado
                        @endif
                    </li>
                    <li class="list-group-item"><strong>Modalidad:</strong> {{ $curso->modalidad }}</li>
                    <ul class="list-group">
                    @foreach ($curso->grupos as $grupo)
                    <li class="list-group-item">
                    <strong>Profesor:</strong> {{ $grupo->pofe ? $grupo->pofe->nombre : 'Sin asignar' }}
                   </li>
                   @endforeach
                    </ul>
                
                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            </div>
        </div>
    </div>
</body>
</html>
