<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Matrícula</title>
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
                <h3>Detalles del formulario</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <p>{{ $formulario->name }}</p>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <p>{{ $formulario->email }}</p>
                </div>

                <div class="form-group">
                    <label for="Documento">Documento</label>
                    <p>{{ $formulario->Documento }}</p>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <p>{{ $formulario->direccion }}</p>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <p>{{ $formulario->telefono }}</p>
                </div>

                <div class="form-group">
                    <label for="fecha_matricula">Fecha de Matrícula</label>
                    <p>{{ $formulario->fecha_matricula }}</p>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <p>{{ $formulario->estado }}</p>
                </div>

                <div class="form-group">
                    <label for="nota_final">Nota Final</label>
                    <p>{{ $formulario->nota_final }}</p>
                </div>

                <div class="form-group">
                    <label for="grupo_id">Curso</label>
                    <p>{{ $formulario->curso->nombre }}</p>
                </div>

                <div class="form-group">
                    <label for="teacher_id">Profesor</label>
                    <p>{{ $formulario->teacher->nombre }}</p>
                </div>

                <div class="form-group">
                    <a href="{{ route('formularios.index') }}" class="btn btn-primary">Volver al Listado</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
