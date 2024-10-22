<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Estilos -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
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
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .text-danger {
            color: #dc3545;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .mt-3 {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Formulario de Inscripción</h2>
    
    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de inscripción -->
    <form action="{{ route('inscripcion.store') }}" method="POST">
        @csrf
        
        <!-- Campo Name -->
        <div class="form-group">
            <label for="name">Nombre</label>
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

        <!-- Campo Password -->
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
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

        <!-- Campo Role ID -->
        <div class="form-group">
            <label for="role_id">Rol</label>
            <select name="role_id" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn">Registrar</button>

        <!-- Botones adicionales para login y register -->
        <div class="mt-3">
            <a href="{{ route('login') }}" class="btn btn-secondary">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
        </div>
    </form>
</div>

<!-- Scripts -->
<script>
    // Puedes agregar cualquier script adicional aquí si lo necesitas
    // Ejemplo: Validación de formulario en el cliente
    document.querySelector('form').addEventListener('submit', function(e) {
        // Aquí puedes añadir validaciones si es necesario
    });
</script>
</body>
</html>
