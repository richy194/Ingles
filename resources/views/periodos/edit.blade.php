<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Periodo Académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }
        .card {
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Editar Periodo Académico</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('periodos.update', $periodo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="año">Año</label>
                        <input type="number" class="form-control" id="año" name="año" value="{{ old('año', $periodo->año) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $periodo->nombre) }}" required>
                    </div>

                    <div class="form-group">
    <label for="periodo">Periodo:</label>
    <select name="periodo" id="periodo" class="form-control" required>
        <option value="SEMESTRE-1" {{ old('periodo', $periodo->periodo) == 'SEMESTRE-1' ? 'selected' : '' }}>SEMESTRE-1</option>
        <option value="SEMESTRE-2" {{ old('periodo', $periodo->periodo) == 'SEMESTRE-2' ? 'selected' : '' }}>SEMESTRE-2</option>
        <option value="TRIMESTRE-1" {{ old('periodo', $periodo->periodo) == 'TRIMESTRE-1' ? 'selected' : '' }}>TRIMESTRE-1</option>
        <option value="TRIMESTRE-2" {{ old('periodo', $periodo->periodo) == 'TRIMESTRE-2' ? 'selected' : '' }}>TRIMESTRE-2</option>
        <option value="TRIMESTRE-3" {{ old('periodo', $periodo->periodo) == 'TRIMESTRE-3' ? 'selected' : '' }}>TRIMESTRE-3</option>
        <option value="TRIMESTRE-4" {{ old('periodo', $periodo->periodo) == 'TRIMESTRE-4' ? 'selected' : '' }}>TRIMESTRE-4</option>
    </select>
</div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $periodo->descripcion) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Actualizar</button>
                    <a href="{{ route('periodos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
