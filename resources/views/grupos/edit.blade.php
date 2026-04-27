<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Grupo</title>
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
                <h1>Editar Grupo</h1>
                <p>Actualiza la información del grupo {{ $grupo->nombre }}.</p>
            </div>
            <div class="actions">
                <a href="{{ route('grupos.index') }}" class="btn btn-neutral">Cancelar</a>
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
                <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group">
                            <label for="curso_id">Curso <span class="required">*</span></label>
                            <select id="curso_id" name="curso_id" class="form-control" required>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ $curso->id == $grupo->curso_id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre <span class="required">*</span></label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $grupo->nombre) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="periodo_id">Período Académico <span class="required">*</span></label>
                            <select id="periodo_id" name="periodo_id" class="form-control" required>
                                <option value="">Seleccione un período</option>
                                @foreach($periodos as $periodo)
                                    <option value="{{ $periodo->id }}" {{ old('periodo_id', $grupo->periodo_id) == $periodo->id ? 'selected' : '' }}>{{ $periodo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="teacher_id">Profesor <span class="required">*</span></label>
                            <select id="teacher_id" name="teacher_id" class="form-control" required>
                                <option value="">Seleccione un profesor</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $grupo->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cantidad">Cantidad de Estudiantes <span class="required">*</span></label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ old('cantidad', $grupo->cantidad) }}" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-brand">Actualizar Grupo</button>
                        <a href="{{ route('grupos.index') }}" class="btn btn-neutral">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
<script>
   document.addEventListener('DOMContentLoaded', () => {
    const agregarButton = document.getElementById('agregar-horario');
    const horariosContainer = document.getElementById('horarios-container');

    let index = document.querySelectorAll('.horario-row').length; // Inicia con el número actual de filas

    agregarButton.addEventListener('click', () => {
        const horarioRow = document.createElement('div');
        horarioRow.classList.add('horario-row');
        horarioRow.innerHTML = `
            <select name="horario[${index}][dia]" class="form-control" required>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
            </select>
            <input type="time" name="horario[${index}][hora_inicio]" class="form-control" required>
            <input type="time" name="horario[${index}][hora_fin]" class="form-control" required>
            <button type="button" class="btn btn-danger btn-sm eliminar-horario">Eliminar</button>
        `;
        horariosContainer.appendChild(horarioRow);
        index++; // Incrementa el índice para la próxima fila
    });

    horariosContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('eliminar-horario')) {
            event.target.closest('.horario-row').remove();
        }
    });
});
</script>
</html>
