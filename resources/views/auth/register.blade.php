<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Asegura que el padding no afecte el ancho total */
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Espacio entre botones */
            font-size: 16px; /* Tamaño de fuente más grande para mejor visibilidad */
        }

        .btn-secondary {
            background-color: #6c757d;
            margin-top: 5px; /* Espacio entre el botón de registro y el de inicio de sesión */
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-secondary:hover {
            opacity: 0.9;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center; /* Alineación centrada del título */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Registrarse</h2>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn">Registrar</button>
        <a href="{{ route('login') }}" class="btn btn-secondary">Iniciar Sesión</a>
        <a href="{{ route('inscripcion.create') }}" class="btn btn-secondary"> Formulario</a>
    </form>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
