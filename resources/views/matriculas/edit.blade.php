<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Matrícula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Agrega jQuery antes de Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- CSS y JS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
                <h3>Editar Matrícula</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="student_id">Cédula del estudiante</label>
                        <select id="student_id" name="student_id" class="form-control" required onchange="autoFillStudentData()">
                            <option value="">Seleccionar Estudiante</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" @if ($student->id == $matricula->student_id) selected @endif>
                                    {{ $student->documento }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="grupo_id">Curso</label>
                        <select id="grupo_id" name="grupo_id" class="form-control" required>
                            <option value="">Seleccionar curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" @if (old('grupo_id', $matricula->grupo_id) == $curso->id) selected @endif>
                                    {{ $curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Profesor</label>
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
                        <label for="fecha_matricula">Fecha de Matrícula</label>
                        <input type="date" id="fecha_matricula" name="fecha_matricula" class="form-control" value="{{ $matricula->fecha_matricula }}" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value="" {{ old('estado', $matricula->estado ?? '') == '' ? 'selected' : '' }}>Seleccionar Estado</option>
                            <option value="aprobado" {{ old('estado', $matricula->estado ?? '') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                            <option value="desaprobado" {{ old('estado', $matricula->estado ?? '') == 'desaprobado' ? 'selected' : '' }}>Desaprobado</option>
                            <option value="cancelado" {{ old('estado', $matricula->estado ?? '') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            <option value="no aprobado" {{ old('estado', $matricula->estado ?? '') == 'no aprobado' ? 'selected' : '' }}>No aprobado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nota_final">Nota Final</label>
                        <input type="number" id="nota_final" name="nota_final" class="form-control" value="{{ $matricula->nota_final ?? '' }}" step="0.01" placeholder="No asignado">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Matrícula</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializa Select2 en el campo de selección de estudiantes
            $('#student_id').select2({
                placeholder: "Buscar estudiante por cédula...",
                allowClear: true,
                width: '100%'
            });

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session("error") }}',
                    confirmButtonText: 'Entendido'
                });
            @endif
        });
    </script>
</body>
</html>