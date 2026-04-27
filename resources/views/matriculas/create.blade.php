<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Matrícula</title>
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
                <h1>Crear Nueva Matrícula</h1>
                <p>Registra una nueva matrícula de estudiante en el sistema.</p>
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

                <form action="{{ route('matriculas.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="student_id">Estudiante <span class="required">*</span></label>
                            <select id="student_id" name="student_id" class="form-control" required>
                                <option value="">Seleccionar Estudiante</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" @if(old('student_id') == $student->id) selected @endif>
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
                                    <option value="{{ $curso->id }}" @if(old('grupo_id') == $curso->id) selected @endif>
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
                                    <option value="{{ $teacher->id }}" @if(old('teacher_id') == $teacher->id) selected @endif>
                                        {{ $teacher->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_matricula">Fecha de Matrícula <span class="required">*</span></label>
                            <input type="date" name="fecha_matricula" class="form-control" value="{{ old('fecha_matricula', date('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="" @if(old('estado') == '') selected @endif>Seleccionar Estado</option>
                                <option value="activo" @if(old('estado') == 'activo') selected @endif>Activo</option>
                                <option value="aprobado" @if(old('estado') == 'aprobado') selected @endif>Aprobado</option>
                                <option value="desaprobado" @if(old('estado') == 'desaprobado') selected @endif>Desaprobado</option>
                                <option value="cancelado" @if(old('estado') == 'cancelado') selected @endif>Cancelado</option>
                                <option value="no aprobado" @if(old('estado') == 'no aprobado') selected @endif>No aprobado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nota_final">Nota Final</label>
                            <input type="number" id="nota_final" name="nota_final" class="form-control" value="{{ old('nota_final', '') }}" step="0.01" min="0" max="100" placeholder="0.00">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-brand">Crear Matrícula</button>
                        <a href="{{ route('matriculas.index') }}" class="btn btn-neutral">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
