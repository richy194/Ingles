<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar sesion | Gestor de Cursos de Ingles</title>
    <link rel="icon" type="image/png" href="{{ asset('img/uteis.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sky-50: #ecfdf3;
            --sky-100: #d2f7e2;
            --sky-300: #86e3b1;
            --sky-500: #1a9b58;
            --sky-600: #147f47;
            --sky-700: #0f6538;
            --teal-500: #1ea565;
            --slate-50: #f8fafc;
            --slate-200: #e2e8f0;
            --slate-500: #64748b;
            --slate-700: #334155;
            --slate-900: #0f172a;
            --white: #ffffff;
            --danger: #dc2626;
            --shadow: 0 25px 45px -18px rgba(12, 86, 47, 0.3);
            --ring: 0 0 0 4px rgba(26, 155, 88, 0.16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            color: var(--slate-900);
            background:
                radial-gradient(1000px 500px at 8% 8%, rgba(134, 227, 177, 0.34), transparent 60%),
                radial-gradient(900px 500px at 92% 92%, rgba(30, 165, 101, 0.22), transparent 60%),
                linear-gradient(135deg, #f5fff9 0%, #effcf4 45%, #f9fffc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-shell {
            width: min(1100px, 100%);
            min-height: 650px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: var(--white);
            animation: rise 0.65s ease-out;
        }

        .brand-side {
            padding: 54px 48px;
            background:
                linear-gradient(165deg, rgba(20, 127, 71, 0.96) 0%, rgba(15, 101, 56, 0.97) 55%, rgba(30, 165, 101, 0.96) 100%);
            color: #f0f9ff;
            position: relative;
            isolation: isolate;
        }

        .brand-side::before,
        .brand-side::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            filter: blur(1px);
            z-index: -1;
        }

        .brand-side::before {
            width: 360px;
            height: 360px;
            right: -120px;
            top: -110px;
            background: rgba(255, 255, 255, 0.08);
        }

        .brand-side::after {
            width: 300px;
            height: 300px;
            left: -140px;
            bottom: -140px;
            background: rgba(187, 247, 208, 0.2);
        }

        .brand-logo {
            width: 92px;
            height: 92px;
            border-radius: 20px;
            object-fit: contain;
            background: rgba(255, 255, 255, 0.12);
            padding: 14px;
            backdrop-filter: blur(6px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.25);
        }

        .brand-tag {
            margin: 26px 0 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            color: #d6fae8;
        }

        .brand-tag::before {
            content: "";
            width: 24px;
            height: 2px;
            background: #bbf7d0;
            border-radius: 10px;
        }

        .brand-title {
            margin: 0;
            font-size: clamp(2rem, 1.75rem + 1vw, 2.7rem);
            line-height: 1.1;
            font-weight: 800;
            max-width: 11ch;
        }

        .brand-description {
            margin-top: 16px;
            max-width: 42ch;
            color: rgba(240, 249, 255, 0.9);
            line-height: 1.62;
            font-size: 15px;
        }

        .feature-list {
            margin-top: 38px;
            display: grid;
            gap: 14px;
        }

        .feature {
            background: rgba(255, 255, 255, 0.11);
            border: 1px solid rgba(187, 247, 208, 0.24);
            border-radius: 14px;
            padding: 13px 14px;
            font-size: 14px;
            color: #e8fff3;
            backdrop-filter: blur(5px);
        }

        .form-side {
            padding: 52px 42px 34px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(180deg, #ffffff 0%, #f8fcff 100%);
        }

        .form-header {
            margin-bottom: 26px;
        }

        .form-title {
            margin: 0;
            color: var(--slate-900);
            font-size: clamp(1.6rem, 1.45rem + 0.6vw, 2rem);
            line-height: 1.2;
            font-weight: 800;
        }

        .form-subtitle {
            margin-top: 10px;
            color: var(--slate-500);
            font-size: 14px;
            line-height: 1.55;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: inline-block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.01em;
            color: var(--slate-700);
        }

        .field input {
            width: 100%;
            height: 48px;
            border: 1px solid var(--slate-200);
            border-radius: 12px;
            padding: 0 14px;
            font-size: 14px;
            color: var(--slate-900);
            background: var(--white);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .field input:focus {
            outline: none;
            border-color: var(--sky-500);
            box-shadow: var(--ring);
            transform: translateY(-1px);
        }

        .row-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 4px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--slate-700);
            user-select: none;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--sky-600);
        }

        .forgot-link {
            font-size: 13px;
            font-weight: 700;
            color: var(--sky-600);
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            border: 0;
            border-radius: 12px;
            height: 50px;
            background: linear-gradient(120deg, var(--sky-600), var(--teal-500));
            color: #f8fafc;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.01em;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
            box-shadow: 0 16px 28px -16px rgba(9, 111, 180, 0.75);
        }

        .login-btn:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .message {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
        }

        .message-success {
            color: #065f46;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
        }

        .message-error {
            color: #7f1d1d;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .form-footer {
            margin-top: 22px;
            color: var(--slate-500);
            font-size: 12px;
            text-align: center;
            line-height: 1.5;
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.985);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width: 960px) {
            .login-shell {
                grid-template-columns: 1fr;
                min-height: 0;
            }

            .brand-side {
                padding: 36px 30px;
            }

            .form-side {
                padding: 36px 26px 30px;
            }

            .brand-title {
                max-width: 100%;
            }
        }

        @media (max-width: 520px) {
            body {
                padding: 14px;
            }

            .brand-side,
            .form-side {
                padding-left: 20px;
                padding-right: 20px;
            }

            .feature-list {
                margin-top: 24px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="brand-side">
            <img src="/img/uteis.png" alt="Logo institucional" class="brand-logo">
            <div class="brand-tag">Campus Virtual</div>
            <h1 class="brand-title">Gestor de Cursos de Ingles</h1>
            <p class="brand-description">
                Administra matriculas, seguimiento academico y procesos de aula en una plataforma clara, segura y optimizada para tu equipo.
            </p>

            <div class="feature-list">
                <div class="feature">Acceso centralizado para docentes, coordinacion y administracion.</div>
                <div class="feature">Control academico en tiempo real con trazabilidad de cambios.</div>
                <div class="feature">Entorno confiable para la gestion institucional diaria.</div>
            </div>
        </section>

        <section class="form-side">
            <header class="form-header">
                <h2 class="form-title">Bienvenido de nuevo</h2>
                <p class="form-subtitle">Ingresa tus credenciales para continuar en la plataforma.</p>
            </header>

            @if (session('status'))
                <div class="message message-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="message message-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Correo electronico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nombre@institucion.edu"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <div class="field">
                    <label for="password">Contrasena</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Ingresa tu contrasena"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <div class="row-inline">
                    <label class="remember" for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        Mantener sesion iniciada
                    </label>

                    @if (\Illuminate\Support\Facades\Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Olvide mi contrasena</a>
                    @endif
                </div>

                <button type="submit" class="login-btn">Iniciar sesion</button>
            </form>

            <p class="form-footer">
                © {{ date('Y') }} Plataforma Academica. Todos los derechos reservados.
            </p>
        </section>
    </main>
</body>
</html>
