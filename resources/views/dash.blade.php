<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Academico</title>
    <link rel="icon" type="image/png" href="{{ asset('img/uteis.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-1: #edf9f2;
            --bg-2: #f8fdf9;
            --ink-1: #11261d;
            --ink-2: #2d4b3f;
            --ink-soft: #6a8478;
            --stroke: #d4e7da;
            --brand-a: #0b7f45;
            --brand-b: #22a562;
            --brand-c: #0f5f34;
            --green: #0e9f6e;
            --card: rgba(255, 255, 255, 0.84);
            --blur: blur(14px);
            --shadow: 0 22px 40px -26px rgba(9, 74, 40, 0.35);
            --radius-lg: 24px;
            --radius-md: 18px;
            --radius-sm: 12px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Public Sans', sans-serif;
            color: var(--ink-1);
            background:
                radial-gradient(900px 520px at 8% 2%, rgba(11, 127, 69, 0.23), transparent 70%),
                radial-gradient(900px 520px at 98% 98%, rgba(34, 165, 98, 0.19), transparent 70%),
                linear-gradient(145deg, var(--bg-1) 0%, var(--bg-2) 100%);
        }

        .shell {
            width: min(1320px, 100% - 34px);
            margin: 26px auto 28px;
            animation: reveal 0.75s ease;
        }

        .hero {
            background: linear-gradient(112deg, rgba(15, 95, 52, 0.96) 0%, rgba(11, 127, 69, 0.94) 50%, rgba(34, 165, 98, 0.92) 100%);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            color: #ecf8ff;
            overflow: hidden;
            position: relative;
            padding: 34px;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 24px;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            pointer-events: none;
        }

        .hero::before {
            width: 340px;
            height: 340px;
            right: -90px;
            top: -120px;
        }

        .hero::after {
            width: 220px;
            height: 220px;
            left: 44%;
            bottom: -120px;
        }

        .hero-logo {
            width: 72px;
            height: 72px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(187, 247, 208, 0.34);
            padding: 10px;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .eyebrow {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #ccfbe4;
            font-weight: 700;
            margin: 0;
        }

        .hero-title {
            margin: 10px 0 8px;
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.55rem, 1.2rem + 1.45vw, 2.5rem);
            line-height: 1.15;
            font-weight: 800;
            max-width: 18ch;
        }

        .hero-subtitle {
            margin: 0;
            color: rgba(236, 248, 255, 0.92);
            max-width: 52ch;
            line-height: 1.58;
            font-size: 14px;
        }

        .hero-side {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .date-badge {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(236, 248, 255, 0.3);
            color: #f0f9ff;
            font-size: 12px;
            font-weight: 700;
            text-align: right;
            letter-spacing: .03em;
        }

        .quick-actions {
            display: grid;
            gap: 10px;
            width: min(280px, 100%);
        }

        .quick-actions a {
            text-decoration: none;
            color: #ecf8ff;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(236, 248, 255, 0.35);
            background: rgba(255, 255, 255, 0.12);
            padding: 10px 12px;
            font-size: 13px;
            font-weight: 700;
            transition: background .2s ease, transform .2s ease;
        }

        .quick-actions a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .stats-grid {
            margin-top: 22px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .stat {
            background: var(--card);
            border: 1px solid rgba(175, 215, 191, 0.58);
            backdrop-filter: var(--blur);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow);
            padding: 16px;
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 26px 45px -30px rgba(11, 111, 56, 0.46);
        }

        .stat-label {
            margin: 0;
            color: var(--ink-soft);
            text-transform: uppercase;
            letter-spacing: .06em;
            font-size: 11px;
            font-weight: 700;
        }

        .stat-value {
            margin: 8px 0 0;
            font-family: 'Sora', sans-serif;
            color: var(--ink-1);
            font-weight: 800;
            font-size: clamp(1.45rem, 1.35rem + .45vw, 1.9rem);
        }

        .content-grid {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .panel {
            background: var(--card);
            border: 1px solid rgba(175, 215, 191, 0.58);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow);
            backdrop-filter: var(--blur);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 295px;
        }

        .panel-head {
            padding: 14px 16px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.86), rgba(246, 252, 255, 0.92));
            border-bottom: 1px solid var(--stroke);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .panel-title {
            margin: 0;
            font-family: 'Sora', sans-serif;
            font-size: 1rem;
            color: var(--ink-2);
            font-weight: 700;
        }

        .panel-link {
            font-size: 12px;
            font-weight: 700;
            color: var(--brand-c);
            text-decoration: none;
        }

        .panel-link:hover {
            text-decoration: underline;
        }

        .panel-body {
            padding: 12px 14px;
            display: grid;
            gap: 10px;
            max-height: 308px;
            overflow: auto;
        }

        .item {
            border: 1px solid var(--stroke);
            border-radius: 13px;
            padding: 10px 12px;
            background: rgba(255, 255, 255, 0.86);
        }

        .item-title {
            margin: 0 0 4px;
            font-size: 14px;
            font-weight: 700;
            color: var(--ink-1);
        }

        .item-meta {
            margin: 0;
            font-size: 12px;
            color: var(--ink-soft);
            line-height: 1.5;
        }

        .empty {
            font-size: 13px;
            color: var(--ink-soft);
            padding: 12px;
            border: 1px dashed var(--stroke);
            border-radius: var(--radius-sm);
            background: rgba(255, 255, 255, 0.6);
        }

        .import-box {
            padding: 16px;
            display: grid;
            gap: 10px;
        }

        .import-box p {
            margin: 0;
            color: var(--ink-soft);
            font-size: 13px;
            line-height: 1.6;
        }

        .import-input {
            width: 100%;
            border: 1px solid var(--stroke);
            border-radius: 10px;
            padding: 8px;
            background: rgba(255, 255, 255, 0.94);
            color: var(--ink-2);
        }

        .import-btn {
            border: 0;
            border-radius: 12px;
            background: linear-gradient(125deg, var(--brand-a), var(--brand-b));
            color: #f8fdff;
            font-weight: 700;
            cursor: pointer;
            height: 42px;
            transition: transform .2s ease, filter .2s ease;
        }

        .import-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.04);
        }

        .flash {
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .flash-success {
            color: #0f5132;
            background: #d1fae5;
            border: 1px solid #99f6d0;
        }

        .flash-error {
            color: #7f1d1d;
            background: #fee2e2;
            border: 1px solid #fecaca;
        }

        .footer {
            text-align: center;
            color: #6c7f95;
            font-size: 12px;
            margin: 18px 0 6px;
        }

        @keyframes reveal {
            from {
                opacity: 0;
                transform: translateY(12px) scale(.99);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width: 1120px) {
            .hero {
                grid-template-columns: 1fr;
                padding: 28px;
            }

            .hero-side {
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 860px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 620px) {
            .shell {
                width: calc(100% - 16px);
                margin-top: 10px;
            }

            .hero,
            .stat,
            .panel {
                border-radius: 16px;
            }

            .hero {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div>
                <img src="/img/utew.png" alt="Logo UTS" class="hero-logo">
                <p class="eyebrow">Panel Academico</p>
                <h1 class="hero-title">Centro de control de cursos de ingles</h1>
                <p class="hero-subtitle">
                    Visualiza el estado del ecosistema academico, revisa ultimos movimientos y ejecuta acciones clave desde un solo lugar.
                </p>
            </div>

            <div class="hero-side">
                <div class="date-badge">
                    {{ now()->format('d/m/Y') }}
                    <br>
                    {{ now()->format('H:i') }}
                </div>

                <div class="quick-actions">
                    <a href="{{ route('matriculas.index') }}">Ir a matriculas</a>
                    <a href="{{ route('estudiantes.index') }}">Gestionar estudiantes</a>
                    <a href="{{ route('profesores.index') }}">Gestionar profesores</a>
                </div>
            </div>
        </section>

        <section class="stats-grid">
            <article class="stat"><p class="stat-label">Cursos</p><p class="stat-value">{{ $stats['cursos'] }}</p></article>
            <article class="stat"><p class="stat-label">Grupos</p><p class="stat-value">{{ $stats['grupos'] }}</p></article>
            <article class="stat"><p class="stat-label">Matriculas</p><p class="stat-value">{{ $stats['matriculas'] }}</p></article>
            <article class="stat"><p class="stat-label">Usuarios</p><p class="stat-value">{{ $stats['usuarios'] }}</p></article>
            <article class="stat"><p class="stat-label">Periodos</p><p class="stat-value">{{ $stats['periodos'] }}</p></article>
            <article class="stat"><p class="stat-label">Formularios</p><p class="stat-value">{{ $stats['formularios'] }}</p></article>
            <article class="stat"><p class="stat-label">Profesores</p><p class="stat-value">{{ $stats['profesores'] }}</p></article>
            <article class="stat"><p class="stat-label">Estudiantes</p><p class="stat-value">{{ $stats['estudiantes'] }}</p></article>
        </section>

        <section class="content-grid">
            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Ultimos cursos</h2>
                    <a class="panel-link" href="{{ route('cursos.index') }}">Ver modulo</a>
                </header>
                <div class="panel-body">
                    @forelse ($cursos as $curso)
                        <div class="item">
                            <p class="item-title">{{ $curso->nombre ?? 'Sin nombre' }}</p>
                            <p class="item-meta">Modalidad: {{ $curso->modalidad ?? 'No definida' }} | Nivel: {{ $curso->nivel_curso ?? 'No definido' }}</p>
                        </div>
                    @empty
                        <div class="empty">No hay cursos registrados aun.</div>
                    @endforelse
                </div>
            </article>

            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Ultimos grupos</h2>
                    <a class="panel-link" href="{{ route('grupos.index') }}">Ver modulo</a>
                </header>
                <div class="panel-body">
                    @forelse ($grupos as $grupo)
                        <div class="item">
                            <p class="item-title">Grupo {{ $grupo->codigo ?? 'N/A' }}</p>
                            <p class="item-meta">Curso: {{ optional($grupo->curso)->nombre ?? 'No asignado' }} | Cupo: {{ $grupo->cantidad ?? 'N/A' }}</p>
                            <p class="item-meta">Docente: {{ optional($grupo->pofe)->nombre ?? 'No asignado' }}</p>
                        </div>
                    @empty
                        <div class="empty">No hay grupos registrados aun.</div>
                    @endforelse
                </div>
            </article>

            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Ultimas matriculas</h2>
                    <a class="panel-link" href="{{ route('matriculas.index') }}">Ver modulo</a>
                </header>
                <div class="panel-body">
                    @forelse ($matriculas as $matricula)
                        <div class="item">
                            <p class="item-title">{{ optional($matricula->student)->nombre ?? 'Estudiante no asignado' }}</p>
                            <p class="item-meta">Documento: {{ optional($matricula->student)->documento ?? 'Sin documento' }}</p>
                            <p class="item-meta">Estado: {{ $matricula->estado ?? 'Sin estado' }} | Nota final: {{ $matricula->nota_final ?? 'N/A' }}</p>
                        </div>
                    @empty
                        <div class="empty">No hay matriculas registradas aun.</div>
                    @endforelse
                </div>
            </article>

            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Periodos academicos</h2>
                    <a class="panel-link" href="{{ route('periodos.index') }}">Ver modulo</a>
                </header>
                <div class="panel-body">
                    @forelse ($periodos as $periodo)
                        <div class="item">
                            <p class="item-title">{{ $periodo->nombre ?? 'Periodo' }} ({{ $periodo->año ?? 'N/A' }})</p>
                            <p class="item-meta">Etapa: {{ $periodo->periodo ?? 'Sin etapa' }}</p>
                            <p class="item-meta">{{ $periodo->descripcion ?? 'Sin descripcion' }}</p>
                        </div>
                    @empty
                        <div class="empty">No hay periodos academicos registrados.</div>
                    @endforelse
                </div>
            </article>

            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Formularios recientes</h2>
                    <a class="panel-link" href="{{ route('formularios.index') }}">Ver modulo</a>
                </header>
                <div class="panel-body">
                    @forelse ($formularios as $formulario)
                        <div class="item">
                            <p class="item-title">{{ $formulario->name ?? 'Sin nombre' }}</p>
                            <p class="item-meta">Correo: {{ $formulario->email ?? 'Sin correo' }}</p>
                            <p class="item-meta">Documento: {{ $formulario->Documento ?? 'Sin documento' }} | Estado: {{ $formulario->estado ?? 'Sin estado' }}</p>
                        </div>
                    @empty
                        <div class="empty">No hay formularios recientes.</div>
                    @endforelse
                </div>
            </article>

            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Importar inscripciones</h2>
                    <a class="panel-link" href="{{ route('formularios.index') }}">Ver modulo</a>
                </header>
                <div class="import-box">
                    <p>Sube tu archivo y procesa inscripciones masivas desde esta consola rapida.</p>
                    <form action="{{ route('formularios.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="import-input" type="file" name="file" required>
                        <button class="import-btn" type="submit">Importar inscripciones</button>
                    </form>

                    @if (session('success'))
                        <div class="flash flash-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="flash flash-error">{{ session('error') }}</div>
                    @endif
                </div>
            </article>

            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Ultimos profesores</h2>
                    <a class="panel-link" href="{{ route('profesores.index') }}">Ver modulo</a>
                </header>
                <div class="panel-body">
                    @forelse ($profesores as $profesor)
                        <div class="item">
                            <p class="item-title">{{ $profesor->nombre ?? 'Sin nombre' }}</p>
                            <p class="item-meta">Correo: {{ $profesor->email ?? 'Sin correo' }}</p>
                        </div>
                    @empty
                        <div class="empty">No hay profesores registrados aun.</div>
                    @endforelse
                </div>
            </article>

            <article class="panel">
                <header class="panel-head">
                    <h2 class="panel-title">Ultimos estudiantes</h2>
                    <a class="panel-link" href="{{ route('estudiantes.index') }}">Ver modulo</a>
                </header>
                <div class="panel-body">
                    @forelse ($estudiantes as $estudiante)
                        <div class="item">
                            <p class="item-title">{{ $estudiante->nombre ?? 'Sin nombre' }}</p>
                            <p class="item-meta">Correo: {{ $estudiante->email ?? 'Sin correo' }}</p>
                            <p class="item-meta">Documento: {{ $estudiante->documento ?? 'Sin documento' }}</p>
                        </div>
                    @empty
                        <div class="empty">No hay estudiantes registrados aun.</div>
                    @endforelse
                </div>
            </article>
        </section>

        <p class="footer">© {{ date('Y') }} UTS | Dashboard academico renovado.</p>
    </div>
</body>
</html>

