<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Periodo Académico</title>
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
    </style>
</head>

<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>nuevo periodo academico </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('periodos.store') }}" method="POST" class="formulario">
                @csrf
                <div class="form-group">
                    <label for="año">Año:</label>
                    <input type="number" name="año" id="año" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
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
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn btn-success mt-3">Guardar</button>
                    <a href="{{ route('periodos.index') }}" class="btn btn-success mt-3">Cancelar</a>
                </div>
            </form>
        </div> 
    </div> 
</div>        
</body>
</html>
