<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
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
                <h3>Editar Profesor</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('profesores.update', $profesor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $profesor->nombre) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $profesor->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Documento">Documento</label>
                        <input type="text" id="Documento" name="Documento" class="form-control" value="{{ old('documento', $profesor->documento) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $profesor->direccion) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', $profesor->telefono) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Profesor</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
