<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
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
                <h1>Editar Curso</h1>
                <p>Actualiza la información del curso.</p>
            </div>
            <div class="actions">
                <a href="{{ route('cursos.index') }}" class="btn btn-neutral">Cancelar</a>
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
                <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre del Curso <span class="required">*</span></label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $curso->nombre) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $curso->codigo) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nivel_curso">Nivel del Curso</label>
                            <select name="nivel_curso" id="nivel_curso" class="form-control" required>
                                <option value="IB1" {{ old('nivel_curso', $curso->nivel_curso) == 'IB1' ? 'selected' : '' }}>IB1</option>
                                <option value="IB2" {{ old('nivel_curso', $curso->nivel_curso) == 'IB2' ? 'selected' : '' }}>IB2</option>
                                <option value="IB3" {{ old('nivel_curso', $curso->nivel_curso) == 'IB3' ? 'selected' : '' }}>IB3</option>
                                <option value="IB4" {{ old('nivel_curso', $curso->nivel_curso) == 'IB4' ? 'selected' : '' }}>IB4</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="modalidad">Modalidad</label>
                            <select name="modalidad" id="modalidad" class="form-control" required>
                                <option value="presencial" {{ old('modalidad', $curso->modalidad) == 'presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="virtual" {{ old('modalidad', $curso->modalidad) == 'virtual' ? 'selected' : '' }}>Virtual</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="teacher_id">Docente</label>
                            <select name="teacher_id" id="teacher_id" class="form-control">
                                <option value="">Seleccionar docente</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $curso->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="periodo_id">Período Académico</label>
                            <select id="periodo_id" name="periodo_id" class="form-control">
                                <option value="">Seleccione un período</option>
                                @foreach($periodos as $periodo)
                                    <option value="{{ $periodo->id }}" {{ old('periodo_id', $curso->periodo_id) == $periodo->id ? 'selected' : '' }}>{{ $periodo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="fecha_inicio" id="fecha_inicio">
                    <input type="hidden" name="fecha_fin" id="fecha_fin">

                    <div class="form-actions">
                        <button type="submit" class="btn btn-brand">Actualizar Curso</button>
                        <a href="{{ route('cursos.index') }}" class="btn btn-neutral">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
