<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
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
                <h3>Editar Curso</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre">Nombre del Curso</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $curso->nombre) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $curso->codigo) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="nivel_curso">Nivel</label>
                        <input type="text" name="nivel_curso" id="nivel_curso" class="form-control" value="{{ old('nivel_curso', $curso->nivel_curso) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $curso->fecha_inicio) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ old('fecha_fin', $curso->fecha_fin) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="requisito">Requisitos</label>
                        <input type="text" name="requisito" id="requisito" class="form-control" value="{{ old('requisito', $curso->requisito) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="modalidad">Modalidad</label>
                        <input type="text" name="modalidad" id="modalidad" class="form-control" value="{{ old('modalidad', $curso->modalidad) }}" required>
                    </div>

                    <!-- Campo para Semestre -->
                    <label for="semestre_id">Semestre</label>
                    <select name="semestre_id" id="semestre_id" class="form-control" required>
                        @foreach ($semestres as $semestre)
                            <option value="{{ $semestre->id }}" {{ old('semestre_id', $curso->semestre_id) == $semestre->id ? 'selected' : '' }}>
                                {{ $semestre->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Campo para Docente -->
                    <label for="teacher_id">Docente</label>
                    <select name="teacher_id" id="teacher_id" class="form-control" required>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $curso->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-warning">Actualizar Curso</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
