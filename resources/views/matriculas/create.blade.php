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
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Crear Matrícula</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('matriculas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="student_id">Estudiante</label>
                        <select id="student_id" name="student_id" class="form-control" required onchange="autoFillStudentData()">
                            <option value="">Seleccionar Estudiante</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                   
                    <div class="form-group">
                        <label for="grupo_id">Curso</label>
                        <select id="grupo_id" name="grupo_id" class="form-control" required>
                            <option value="">Seleccionar Grupo</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Profesor</label>
                        <select id="teacher_id" name="teacher_id" class="form-control" required>
                            <option value="">Seleccionar Profesor</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_matricula">Fecha de Matrícula</label>
                        <input type="date" id="fecha_matricula" name="fecha_matricula" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nota_final">Nota Final</label>
                        <input type="number" id="nota_final" name="nota_final" class="form-control" step="0.01" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Matrícula</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function autoFillStudentData() {
        const studentId = document.getElementById('student_id').value;
        if (studentId) {
            // Solicitud a la API para obtener los datos del estudiante
            fetch(`/student-data/${studentId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los datos del estudiante');
                    }
                    return response.json();
                })
                .then(data => {
                    // Rellenar los campos del formulario con los datos recibidos
                    document.getElementById('name').value = data.nombre;
                    document.getElementById('email').value = data.email;
                    document.getElementById('Documento').value = data.Documento;
                    document.getElementById('direccion').value = data.direccion;
                    document.getElementById('telefono').value = data.telefono;
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Opcional: Limpiar los campos si ocurre un error
                    document.getElementById('name').value = '';
                    document.getElementById('email').value = '';
                    document.getElementById('Documento').value = '';
                    document.getElementById('direccion').value = '';
                    document.getElementById('telefono').value = '';
                });
        } else {
            // Limpiar los campos si no hay un estudiante seleccionado
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('Documento').value = '';
            document.getElementById('direccion').value = '';
            document.getElementById('telefono').value = '';
        }
    }
</script>
</body>
</html>
