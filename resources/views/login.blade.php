<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        .login-container input {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }
        .login-container input:focus {
            background: rgba(255, 255, 255, 0.3);
            outline: none;
            box-shadow: 0 0 5px #fff;
        }
        .btn-login {
            background-color: #4e73df;
            border: none;
        }
        .btn-login:hover {
            background-color: #375acd;
        }
    </style>
</head>
<body>
    <div class="login-container text-center">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Ingresar</button>
            <div class="mt-3">
                <a href="#" class="text-white">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
