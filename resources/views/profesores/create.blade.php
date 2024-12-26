<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Profesor</title>
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
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3> Nuevo Profesor</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('profesores.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Documento">Documento</label>
                        <input type="text" name="Documento" id="Documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Crear formulario</button>
                    <a href="{{ route('profesores.index') }}" class="btn btn-success mt-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
