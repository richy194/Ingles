<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Matrícula</title>
    <link rel="icon" type="image/png" href="{{ asset('img/uteis.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&family=Sora:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modern-admin.css') }}">
</head>
<body>
    <div class="page-shell">
        <section class="hero">
            <div>
                <h1>Editar Matrícula</h1>
                <p>Actualiza los datos completos de esta matrícula del estudiante.</p>
            </div>
            <div class="actions">
                <a href="{{ route('matriculas.index') }}" class="btn btn-neutral">Cancelar</a>
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Por favor revisa los errores:</strong>
                        <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="student_id">Estudiante <span class="required">*</span></label>
                            <select id="student_id" name="student_id" class="form-control" required>
                                <option value="">Seleccionar Estudiante</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" @if ($student->id == $matricula->student_id) selected @endif>
                                        {{ $student->nombre }} ({{ $student->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="grupo_id">Curso <span class="required">*</span></label>
                            <select id="grupo_id" name="grupo_id" class="form-control" required>
                                <option value="">Seleccionar Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}" @if (old('grupo_id', $matricula->grupo_id) == $curso->id) selected @endif>
                                        {{ $curso->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="teacher_id">Profesor <span class="required">*</span></label>
                            <select id="teacher_id" name="teacher_id" class="form-control" required>
                                <option value="">Seleccionar Profesor</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @if ($teacher->id == $matricula->teacher_id) selected @endif>
                                        {{ $teacher->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_matricula">Fecha de Matrícula <span class="required">*</span></label>
                            <input type="date" id="fecha_matricula" name="fecha_matricula" class="form-control" value="{{ $matricula->fecha_matricula }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="" {{ old('estado', $matricula->estado ?? '') == '' ? 'selected' : '' }}>Seleccionar Estado</option>
                                <option value="activo" {{ old('estado', $matricula->estado ?? '') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="aprobado" {{ old('estado', $matricula->estado ?? '') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                <option value="desaprobado" {{ old('estado', $matricula->estado ?? '') == 'desaprobado' ? 'selected' : '' }}>Desaprobado</option>
                                <option value="cancelado" {{ old('estado', $matricula->estado ?? '') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                <option value="no aprobado" {{ old('estado', $matricula->estado ?? '') == 'no aprobado' ? 'selected' : '' }}>No aprobado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nota_final">Nota Final</label>
                            <input type="number" id="nota_final" name="nota_final" class="form-control" value="{{ $matricula->nota_final ?? '' }}" step="0.01" min="0" max="100" placeholder="0.00">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-brand">Guardar Cambios</button>
                        <a href="{{ route('matriculas.index') }}" class="btn btn-neutral">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
