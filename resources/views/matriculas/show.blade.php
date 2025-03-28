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
        .details-label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        .details-value {
            margin-bottom: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Detalles de la Matrícula</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="details-label">Estudiante:</label>
                    <p class="details-value">{{ $matricula->student->nombre }}</p>
                </div>
                <div class="form-group">
                    <label class="details-label">nombre :</label>
                    <p class="details-value">{{ $matricula->student->nombre }}</p>
                </div>
                <div class="form-group">
                    <label class="details-label">correo estudiantil:</label>
                    <p class="details-value">{{ $matricula->student->email }}</p>
                </div>
                <div class="form-group">
                    <label class="details-label">Documento :</label>
                    <p class="details-value">{{ $matricula->student->documento }}</p>
                </div> 
              
                <div class="form-group">
                    <label class="details-label">direccion:</label>
                    <p class="details-value">{{ $matricula->student->direccion }}</p>
                </div>
                <div class="form-group">
                    <label class="details-label">telefono:</label>
                    <p class="details-value">{{ $matricula->student->telefono }}</p>
                </div>

                <div class="form-group">
                    <label class="details-label">curso:</label>
                    <p class="details-value">{{ $matricula->curso->nombre ?? 'Sin asignar' }}</p>
                </div>

                <div class="form-group">
                    <label class="details-label">Profesor:</label>
                    <p class="details-value">{{ $matricula->teacher->nombre ?? 'Sin asignar' }}</p>
                </div>

                <div class="form-group">
                    <label class="details-label">Fecha de Matrícula:</label>
                    <p class="details-value">{{ $matricula->fecha_matricula }}</p>
                </div>

                <div class="form-group">
                    <label class="details-label">Estado:</label>
                    <p class="details-value">{{ $matricula->estado }}</p>
                </div>

                <div class="form-group">
                    <label class="details-label">Nota Final:</label>
                    <p class="details-value">{{ $matricula->nota_final ?? 'No asignada' }}</p>
                </div>

                <div class="form-group text-center">
                    <a href="{{ route('matriculas.index') }}" class="btn btn-primary">Volver </a>
                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>
