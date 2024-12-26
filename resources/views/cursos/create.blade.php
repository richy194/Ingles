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
        }
        .btn {
            margin-top: 10px;
            background-color: #a8e6cf;
            color: #fff;
        }
        select[multiple] {
    height: auto;
    min-height: 100px;
}
        .btn:hover {
            background-color: #80e0bb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3> Nuevo Curso</h3>
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

                    <!-- Campo para periodo academico -->
                    <div class="form-group">
                        <label for="periodo_id">Periodo Académico</label>
                        <select id="periodo_id" name="periodo_id" class="form-control" required>
                            <option value="">Seleccione un periodo</option>
                            @foreach($periodos as $periodo)
                                <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

<div class="form-group">
    <label for="grupo_id">Grupos</label>
    <select id="grupo_id" name="grupo_id[]" class="form-control" multiple required>
        <option value="">Seleccione uno o más grupos</option>
        @foreach($grupos as $grupo)
            <option value="{{ $grupo->id }}" 
                @if(in_array($grupo->id, old('grupo_id', [])))
                    selected
                @endif
            >
                {{ $grupo->nombre }}
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

                    <button type="submit" class="btn btn-primary">crear curso</button>
                    <a href="{{ route('cursos.index') }}" class="btn btn-primary">Volver </a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
