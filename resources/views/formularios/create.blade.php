<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear inscripcion</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>nueva inscripcion</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('formularios.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento" value="{{ old('documento') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
                    </div>

                    <label for="fecha_matricula">Fecha de Matrícula</label>
        <input 
        type="date" 
        name="fecha_matricula" 
        class="form-control" 
        value="{{ date('Y-m-d') }}" 
        required 
        readonly>

                    <div class="form-group">
    <label for="estado">Estado</label>
    <select class="form-control" id="estado" name="estado">
        <option value="" {{ old('estado', $formularioInscripcion->estado ?? '') == '' ? 'selected' : '' }}>Seleccionar Estado</option>
        <option value="aprobado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
        <option value="desaprobado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'desaprobado' ? 'selected' : '' }}>Desaprobado</option>
        <option value="cancelado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
        <option value="no aprobado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'no aprobado' ? 'selected' : '' }}>No aprobado</option>
    </select>
</div>


<div class="form-group">
    <label for="nota_final">Nota Final</label>
    <input type="number" 
           id="nota_final" 
           name="nota_final" 
           class="form-control" 
           value="{{ $matricula->nota_final ?? '' }}" 
           step="0.01" 
           placeholder="No asignado" 
           >
</div>

                    <div class="form-group">
    <label for="grupo_id">Curso</label>
    <select class="form-control" id="grupo_id" name="grupo_id" required>
        <option value="">Seleccionar Curso</option>
        @foreach ($cursos as $curso)
            <option value="{{ $curso->id }}" 
                @selected(old('grupo_id') == $curso->id)>
                {{ $curso->nombre }}
            </option>
        @endforeach
    </select>
</div>

                    <div class="form-group">
                        <label for="teacher_id">Profesor</label>
                        <select class="form-control" id="teacher_id" name="teacher_id" required>
                            <option value="">Seleccionar Profesor</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Crear formulario</button>
                    <a href="{{ route('formularios.index') }}" class="btn btn-success mt-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
