<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Matrícula</title>
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
                <h3>Editar Matrícula</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $matricula->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $matricula->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Documento">Documento</label>
                        <input type="text" name="Documento" id="Documento" class="form-control" value="{{ old('Documento', $matricula->Documento) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="grupo_id">Curso</label>
                        <select name="grupo_id" id="grupo_id" class="form-control" required>
                            <option value="">Seleccionar Curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('grupo_id', $matricula->grupo_id) == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Profesor</label>
                        <select name="teacher_id" id="teacher_id" class="form-control" required>
                            <option value="">Seleccionar Profesor</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id', $matricula->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning">Actualizar Matrícula</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
