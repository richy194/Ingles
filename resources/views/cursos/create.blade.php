<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }
        .card {
            margin-top: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .btn-primario {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
        }
        .btn-primario:hover {
            background-color: #0056b3;
        }
        .btn-secundario {
            background-color: #6c757d;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
        }
        .btn-secundario:hover {
            background-color: #5a6268;
        }
        .form-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Crear Nuevo Curso</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre del Curso</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                   <label for="nivel_curso">Nivel del Curso</label>
                  <select name="nivel_curso" id="nivel_curso" class="form-control" required>
                 <option value="A1" {{ old('nivel_curso') == 'A1' ? 'selected' : '' }}>A1</option>
                 <option value="A2" {{ old('nivel_curso') == 'A2' ? 'selected' : '' }}>A2</option>
                 <option value="B1" {{ old('nivel_curso') == 'B1' ? 'selected' : '' }}>B1</option>
                 <option value="B2" {{ old('nivel_curso') == 'B2' ? 'selected' : '' }}>B2</option>
                 <option value="C1" {{ old('nivel_curso') == 'C1' ? 'selected' : '' }}>C1</option>
                 <option value="C2" {{ old('nivel_curso') == 'C2' ? 'selected' : '' }}>C2</option>
                </select>
                 </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="requisito">Requisitos</label>
                        <input type="text" name="requisito" id="requisito" class="form-control" required>
                    </div>

                    <div class="form-group">
                   <label for="modalidad">Modalidad</label>
                   <select name="modalidad" id="modalidad" class="form-control" required>
                  <option value="presencial" {{ old('modalidad') == 'presencial' ? 'selected' : '' }}>Presencial</option>
                   <option value="virtual" {{ old('modalidad') == 'virtual' ? 'selected' : '' }}>Virtual</option>
                     </select>
                      </div>

                    <!-- Campo para Semestre -->
                    <div class="form-group">
                        <label for="semestre_id">Semestre</label>
                        <select name="semestre_id" id="semestre_id" class="form-control" required>
                            @foreach ($semestres as $semestre)
                                <option value="{{ $semestre->id }}" {{ old('semestre_id') == $semestre->id ? 'selected' : '' }}>
                                    {{ $semestre->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo para Docente -->
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

                    <button type="submit" class="btn btn-primary">Crear Curso</button>
                    <a href="{{ route('cursos.index') }}" class="btn-secundario">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
