<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscripción</title>

    <!-- Estilos CSS -->
    <style>
      body {
    font-family: Arial, sans-serif;
    background: url('/img/blanq.jpg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
}

.institutional-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.logo-container {
    margin-bottom: 20px;
}

.logo-container img {
    max-width: 150px;
}

.form-container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

input,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    transition: border-color 0.3s;
}

input:focus,
select:focus {
    border-color: #007bff;
    outline: none;
}

.btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3;
}

.alert {
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
} 
 </style>
</head>
<body>
    <div class="institutional-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="/img/ute.png"  alt="Logo Institucional">
        </div>

        <div class="form-container">
            <h2>Formulario de Inscripción</h2>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario -->
            <form action="{{ route('matricula.store') }}" method="POST">
                @csrf
                <div class="form-group">
                <label for="name">Nombre Completo</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Email -->
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Documento -->
            <div class="form-group">
                <label for="Documento">Documento</label>
                <input type="text" name="Documento" class="form-control" required value="{{ old('Documento') }}">
                @error('Documento')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Dirección -->
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control" required value="{{ old('direccion') }}">
                @error('direccion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo Teléfono -->
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                @error('telefono')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                <!-- Fecha de matrícula -->
                <div class="form-group">
                    <label for="fecha_matricula">Fecha de Matrícula</label>
                    <input type="date" name="fecha_matricula" class="form-control" required>
                </div>

               

                <!-- Estado -->
                <div class="form-group">
    <label for="estado">Estado</label>
    <select class="form-control" id="estado" name="estado">
        <option value="" {{ old('estado', $formularioInscripcion->estado ?? '') == '' ? 'selected' : '' }}>Seleccionar Estado</option>
        <option value="aprobado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
        <option value="desaprobado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'desaprobado' ? 'selected' : '' }}>Desaprobado</option>
        <option value="cancelado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
        <option value="no aprobado" {{ old('estado', $formularioInscripcion->estado ?? '') == 'no aprobado' ? 'selected' : '' }}>No aprobado</option>
    </select>

                <!-- Nota final -->
                <div class="form-group">
                    <label for="nota_final">Nota Final</label>
                    <input type="number" step="0.1" name="nota_final" class="form-control">
                </div>

               

                <!-- Profesor -->
                <div class="form-group">
                    <label for="teacher_id">Profesor</label>
                    <select name="teacher_id" class="form-control" required>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Grupo -->
                <div class="form-group">
                    <label for="grupo_id">Grupo</label>
                    <select name="grupo_id" class="form-control">
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn">Registrar Matrícula</button>
            </form>
        </div>
    </div>

    <!-- Scripts JS -->
    <script >
        document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');

    form.addEventListener('submit', (event) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach((field) => {
            if (!field.value.trim()) {
                isValid = false;
                alert(`El campo ${field.name} es obligatorio.`);
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
});
    </script>
</body>
</html>
