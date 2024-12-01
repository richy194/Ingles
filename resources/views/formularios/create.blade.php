<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Matrícula</title>
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
                <h3>Crear formulario de inscripcion</h3>
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
                        <label for="Documento">Documento</label>
                        <input type="text" class="form-control" id="Documento" name="Documento" value="{{ old('Documento') }}" required>
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
                        <input type="number" step="0.01" class="form-control" id="nota_final" name="nota_final" value="{{ old('nota_final') }}">
                    </div>

                    <div class="form-group">
                        <label for="grupo_id">Curso</label>
                        <select class="form-control" id="grupo_id" name="grupo_id" required>
                            <option value="">Seleccionar Curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('grupo_id') == $curso->id ? 'selected' : '' }}>
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
                    <a href="{{ route('formularios.index') }}" class="btn-secundario">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
