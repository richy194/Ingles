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
            padding: 30px;
        }
        .btn {
            margin-top: 10px;
            background-color: #a8e6cf;
            color: #fff;
        }
        .btn:hover {
            background-color: #80e0bb;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Editar Periodo Académico</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('periodos.update', $periodo->id ) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
    <label for="año">Año</label>
    <input 
        type="number" 
        name="año" 
        id="año" 
        class="form-control" 
        value="{{ old('año', $periodo->año) }}" 
        required
    >
</div>

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input 
        type="text" 
        name="nombre" 
        id="nombre" 
        class="form-control" 
        value="{{ old('nombre', $periodo->nombre) }}" 
        required
    >
</div>

<div class="form-group">
                    <label for="periodo">Periodo:</label>
                    <select name="periodo" id="periodo" class="form-control" required>
                        <option value="SEMESTRE-1" {{ old('periodo') == 'SEMESTRE-1' ? 'selected' : '' }}>SEMESTRE-1</option>
                        <option value="SEMESTRE-2" {{ old('periodo') == 'SEMESTRE-2' ? 'selected' : '' }}>SEMESTRE-2</option>
                        <option value="TRIMESTRE-1" {{ old('periodo') == 'TRIMESTRE-1' ? 'selected' : '' }}>TRIMESTRE-1</option>
                        <option value="TRIMESTRE-2" {{ old('periodo') == 'TRIMESTRE-2' ? 'selected' : '' }}>TRIMESTRE-2</option>
                        <option value="TRIMESTRE-3" {{ old('periodo') == 'TRIMESTRE-3' ? 'selected' : '' }}>TRIMESTRE-3</option>
                        <option value="TRIMESTRE-4" {{ old('periodo') == 'TRIMESTRE-4' ? 'selected' : '' }}>TRIMESTRE-4</option>
                        <option value="TRIMESTRE-5" {{ old('periodo') == 'TRIMESTRE-5' ? 'selected' : '' }}>TRIMESTRE-5</option>
                        <option value="TRIMESTRE-6" {{ old('periodo') == 'TRIMESTRE-6' ? 'selected' : '' }}>TRIMESTRE-6</option>
                    </select>
                </div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea 
        name="descripcion" 
        id="descripcion" 
        class="form-control" 
        rows="4"
    >{{ old('descripcion', $periodo->descripcion) }}</textarea>
</div>

                    <button type="submit" class="btn btn-primary">Actualizar Periodo</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

