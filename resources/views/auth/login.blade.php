<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Zenthic</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* background: url('/img/verdx.avif') no-repeat center center fixed; */
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .login-container {
            max-width: 450px;
            margin: 100px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .logo-container img {
            width: 120px;
            display: block;
            margin: 0 auto 20px;
        }
        .login-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #0056b3;
            margin-bottom: 20px;
        }
        .form-control {
            height: 45px;
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
            font-weight: bold;
            height: 45px;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #003d82;
        }
        .footer-text {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 20px;
        }
        .footer-text a {
            color: #0056b3;
            text-decoration: none;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
        .info-box {
            background: #f7f9fc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-container">
                    <!-- Logo de UTS -->
                    <div class="logo-container">
                        <img src="/img/uteis.png" ">
                    </div>
                    <h2 class="login-title">Gestor Cursos de Ingles</h2>
                    
                    

                    <!-- Formulario de login -->
                    <form  method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Campo Usuario -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu correo" required>
                        </div>
                        <!-- Campo Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                        </div>
                        <!-- Botón de Inicio -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                    </form>

                    <!-- Enlace Olvidaste tu Contraseña -->
                    <div class="text-center mt-3">
                        <a href="#" class="text-secondary">¿Olvidaste tu contraseña?</a>
                    </div>

                    <!-- Pie de página -->
                    <div class="footer-text">
                        <p>© 2024 richy corp - quiero la chamba. Todos los derechos reservados.</p>
                        <p><a href="#">Política de privacidad</a> | <a href="#">Términos de uso</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
