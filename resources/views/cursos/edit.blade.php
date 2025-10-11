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
            background-color: #a8e6cf;
            color: #fff;
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
                        <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $curso->codigo) }}" >
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                    </div>

                    <div class="form-group">
                   <label for="nivel_curso">Nivel del Curso</label>
                  <select name="nivel_curso" id="nivel_curso" class="form-control" required>
                 <option value="IB1" {{ old('nivel_curso') == 'IB1' ? 'selected' : '' }}>IB1</option>
                 <option value="IB2" {{ old('nivel_curso') == 'IB2' ? 'selected' : '' }}>IB2</option>
                 <option value="IB3" {{ old('nivel_curso') == 'IB3' ? 'selected' : '' }}>IB3</option>
                 <option value="IB4" {{ old('nivel_curso') == 'IB4' ? 'selected' : '' }}>IB4</option>
                
                </select>
                 </div>

                 <div class="form-group">
                        
                        <input type="hidden" name="fecha_inicio" id="fecha_inicio" class="form-control" >
                    </div>

                    <div class="form-group">
                        
                        <input type="hidden" name="fecha_fin" id="fecha_fin" class="form-control" >
                    </div>

                    <div class="form-group">
    <label for="requisito">Requisitos</label>
    <select name="requisito" id="requisito" class="form-control">
        <option value="">Ninguno</option>
        @foreach($cursos as $curso)
            <option value="{{ $curso->id }}" 
                {{ old('requisito', $curso->requisito) == $curso->id ? 'selected' : '' }}>
                {{ $curso->nombre }}
            </option>
        @endforeach
    </select>
</div>

                    <div class="form-group">
                   <label for="modalidad">Modalidad</label>
                   <select name="modalidad" id="modalidad" class="form-control" required>
                  <option value="presencial" {{ old('modalidad') == 'presencial' ? 'selected' : '' }}>Presencial</option>
                   <option value="virtual" {{ old('modalidad') == 'virtual' ? 'selected' : '' }}>Virtual</option>
                     </select>
                      </div>


 <div class="form-group">
                        <label for="teacher_id">Docente</label>
                        <select name="teacher_id" id="teacher_id" class="form-control" >
                            <option value="">Seleccionar docente</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->nombre }}</option>
                            @endforeach
                        </select>
                    </div>








                    <!-- Campo para periodo academico -->
                    <div class="form-group">
    <label for="periodo_id">Periodo Académico</label>
    <select id="periodo_id" name="periodo_id" class="form-control" >
        <option value="">Seleccione un periodo</option>
        @foreach($periodos as $periodo)
            <option value="{{ $periodo->id }}" 
                {{ old('periodo_id', $curso->periodo_id) == $periodo->id ? 'selected' : '' }}>
                {{ $periodo->nombre }}
            </option>
        @endforeach
    </select>
</div>

                   

                    <!-- Campo para Docente -->
                    

                    <button type="submit" class="btn btn-primary">actualizar Grupo</button>
                    <a href="{{ route('cursos.index') }}" class="btn btn-primary">Volver </a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
