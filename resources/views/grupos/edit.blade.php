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
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
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
                        <label for="codigo">Código</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $grupo->codigo) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="curso_id">Curso</label>
                        <select name="curso_id" id="curso_id" class="form-control" required>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('curso_id', $grupo->curso_id) == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="periodo_id">Periodo Académico</label>
                        <select name="periodo_id" id="periodo_id" class="form-control" required>
                            @foreach($periodos as $periodo)
                                <option value="{{ $periodo->id }}" {{ old('periodo_id', $grupo->periodo_id) == $periodo->id ? 'selected' : '' }}>{{ $periodo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad', $grupo->cantidad) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Docente</label>
                        <select name="teacher_id" id="teacher_id" class="form-control" required>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning">Actualizar Grupo</button>
                    <a href="{{ route('grupos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
