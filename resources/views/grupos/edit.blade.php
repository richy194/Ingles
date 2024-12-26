<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Grupo</title>
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
                <h3>Editar Grupo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="curso_id">Curso</label>
                        <select id="curso_id" name="curso_id" class="form-control" required>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ $curso->id == $grupo->curso_id ? 'selected' : '' }}>
                                    {{ $curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $grupo->nombre }}" required>
                    </div>

                    <div class="form-group">
    <label for="periodo_id">Periodo Académico</label>
    <select id="periodo_id" name="periodo_id" class="form-control" required>
        <option value="">Seleccione un periodo</option>
        @foreach($periodos as $periodo)
            <option value="{{ $periodo->id }}" 
                {{ old('periodo_id', $grupo->periodo_id) == $periodo->id ? 'selected' : '' }}>
                {{ $periodo->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="teacher_id">Profesor</label>
    <select id="teacher_id" name="teacher_id" class="form-control" required>
        <option value="">Seleccione un profesor</option>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}" 
                {{ old('teacher_id', $grupo->teacher_id) == $teacher->id ? 'selected' : '' }}>
                {{ $teacher->nombre }}
            </option>
        @endforeach
    </select>
</div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ $grupo->cantidad }}" required>
                    </div>

                    <div class="form-group">
                        <label for="horario">Horario</label>
                        <input type="text" id="horario" name="horario" class="form-control" value="{{ $grupo->horario }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Grupo</button>
                    <a href="{{ route('grupos.index') }}" class="btn btn-primary">Volver </a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
