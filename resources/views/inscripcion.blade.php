<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscripción</title>

    <!-- Estilos CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('/img/blanq.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .institutional-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .logo-container {
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 150px;
            margin-bottom: 30px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            backdrop-filter: blur(10px);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 1.8em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            font-size: 1.1em;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            transition: border-color 0.3s ease;
            font-size: 1em;
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
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            font-size: 1.1em;
        }

        .back-btn {
            background-color: #f8f9fa;
            color: #007bff;
            border: 1px solid #007bff;
            padding: 12px 20px;
            border-radius: 6px;
            text-align: center;
            width: 100%;
            font-size: 1.1em;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #e2e6ea;
        }

        .form-container input[type="date"] {
            background-color: #f8f9fa;
            color: #333;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="institutional-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="/img/ute.png" alt="Logo Institucional">
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
            <form action="{{ route('formularios.store') }}" method="POST">
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

                <div class="form-group">
                    <label for="fecha_matricula">Fecha de Matrícula</label>
                    <input 
                        type="date" 
                        name="fecha_matricula" 
                        class="form-control" 
                        value="{{ date('Y-m-d') }}" 
                        required 
                        readonly>
                </div>

                <!-- Estado (oculto) -->
                <input type="hidden" name="estado" value="pendiente">

                <!-- Nota final (oculta) -->
                <input type="hidden" name="nota_final" value="0">

                <!-- Profesor (oculto) -->
                <input type="hidden" name="teacher_id" value="{{ $teachers->first()->id ?? '' }}">

                <!-- Grupo -->
                <div class="form-group">
                    <label for="grupo_id">Curso</label>
                    <select name="grupo_id" class="form-control">
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class=" btn btn-regresar">Realizar Registro</button>
            </form>

            <!-- Botón para regresar al dashboard -->
            <form action="{{ route('dashboard') }}" method="GET" style="margin-top: 20px;">
                <button type="submit" class="btn  btn-regresarn">Regresar </button>
            </form>
        </div>
    </div>

    <!-- Scripts JS -->
    <script>
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
