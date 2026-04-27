<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Inscripción</title>
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
                <h1>Crear Nueva Inscripción</h1>
                <p>Registra una nueva inscripción en el sistema.</p>
            </div>
            <div class="actions">
                <a href="{{ route('formularios.index') }}" class="btn btn-neutral">Cancelar</a>
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
                <form action="{{ route('formularios.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nombre <span class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico <span class="required">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="documento">Documento <span class="required">*</span></label>
                            <input type="text" class="form-control" id="documento" name="documento" value="{{ old('documento') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
                        </div>

                        <div class="form-group">
                            <label for="fecha_matricula">Fecha de Matrícula</label>
                            <input type="date" class="form-control" id="fecha_matricula" name="fecha_matricula" value="{{ old('fecha_matricula', date('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="">Seleccionar Estado</option>
                                <option value="aprobado" {{ old('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                <option value="desaprobado" {{ old('estado') == 'desaprobado' ? 'selected' : '' }}>Desaprobado</option>
                                <option value="cancelado" {{ old('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                <option value="no aprobado" {{ old('estado') == 'no aprobado' ? 'selected' : '' }}>No aprobado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nota_final">Nota Final</label>
                            <input type="number" id="nota_final" name="nota_final" class="form-control" value="{{ old('nota_final') }}" step="0.01">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="grupo_id">Curso <span class="required">*</span></label>
                            <select class="form-control" id="grupo_id" name="grupo_id" required>
                                <option value="">Seleccionar Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ old('grupo_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="teacher_id">Profesor</label>
                            <select class="form-control" id="teacher_id" name="teacher_id">
                                <option value="">Seleccionar Profesor</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-brand">Crear Inscripción</button>
                        <a href="{{ route('formularios.index') }}" class="btn btn-neutral">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
