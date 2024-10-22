<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: white;
            padding: 40px; /* Espacio interno mayor */
            border-radius: 12px; /* Bordes más redondeados */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Sombra más profunda */
            width: 400px; /* Ancho más amplio */
            transition: all 0.3s; /* Transición suave para hover */
        }

        .container:hover {
            transform: translateY(-5px); /* Efecto de elevación al pasar el mouse */
        }

        h2 {
            margin-bottom: 30px; /* Más espacio debajo del título */
            text-align: center; /* Alineación centrada del título */
            color: #333; /* Color de texto más oscuro */
            font-size: 24px; /* Tamaño de fuente más grande */
        }

        .form-group {
            margin-bottom: 20px; /* Más espacio entre grupos de formulario */
        }

        label {
            display: block; /* Asegura que la etiqueta ocupe toda la línea */
            margin-bottom: 5px; /* Espacio entre etiqueta y campo */
            color: #555; /* Color más suave para las etiquetas */
            font-weight: 600; /* Negrita para mejor legibilidad */
        }

        .form-control {
            width: 100%;
            padding: 12px; /* Padding mayor para mayor comodidad */
            border: 1px solid #ccc; /* Borde más claro */
            border-radius: 6px; /* Bordes redondeados */
            box-sizing: border-box; /* Asegura que el padding no afecte el ancho total */
            font-size: 16px; /* Tamaño de fuente más grande para mejor visibilidad */
            transition: border-color 0.3s; /* Transición para el cambio de borde */
        }

        .form-control:focus {
            border-color: #007bff; /* Cambio de color al hacer foco */
            outline: none; /* Elimina el contorno */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Sombra al enfocar */
        }

        .btn {
            width: 100%;
            padding: 12px; /* Padding mayor para mayor comodidad */
            background-color: #007bff; /* Color primario */
            color: white;
            border: none;
            border-radius: 6px; /* Bordes redondeados */
            cursor: pointer;
            margin-top: 15px; /* Espacio entre botones */
            font-size: 18px; /* Tamaño de fuente más grande */
            transition: background-color 0.3s; /* Transición suave para el hover */
        }

        .btn-secondary {
            background-color: #6c757d; /* Color secundario */
            margin-top: 20px; /* Mayor espacio entre el botón de inicio de sesión y los botones secundarios */
        }

        .btn:hover {
            background-color: #0056b3; /* Cambio de color al pasar el mouse */
        }

        .btn-secondary:hover {
            background-color: #5a6268; /* Cambio de color al pasar el mouse */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn">Iniciar Sesión</button>
        <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
        <a href="{{ route('inscripcion.create') }}" class="btn btn-secondary">Formulario</a>
    </form>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
