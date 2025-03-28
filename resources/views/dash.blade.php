<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        /* Fondo y colores generales */
        body {
            font-family: 'Arial', sans-serif;
            background: url('/img/blanq.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        /* Contenedor principal */
        .content {
            flex: 1;
            padding: 20px 15px;
            margin-top: 20px;
        }

        /* Secciones (tarjetas) */
        .card {
            background-color: #fffff5;
            color: #495057;
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
            height: 100%; /* Asegura que todas las tarjetas tengan la misma altura */
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #28a745;
            color: #fff;
            text-align: center;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
            font-size: 1.2rem;
        }

        .card-body {
            padding: 20px;
            flex-grow: 1; /* Esto hace que el cuerpo de la tarjeta ocupe el espacio restante */
            overflow-y: auto; /* Añade desplazamiento si el contenido excede */
            max-height: 300px; /* Limita la altura de las listas */
        }

        .btn-link {
    color: #28a745; /* Error tipográfico, debería ser #28a745 */
}

        .btn-link:hover {
            text-decoration: underline;
        }

        /* Estilo del footer */
        footer {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 0.9rem;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
        }

        footer a {
            color: #ffc107;
            font-weight: bold;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer .footer-link {
            margin-left: 10px;
        }

        /* Logo */
        .logo {
            text-align: center;
            margin: 20px 0;
        }

        .logo img {
            width: 200px;
            height: auto;
        }

        /* Estilo de los íconos y detalles dentro de las tarjetas */
        .card-body ul li {
            background-color: #f8f9f2;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 20px;
        }
        .card-body ul li {
    max-height: 250px;
    overflow-y: auto;
}

        .card-body ul li:hover {
            background-color: #e2e6ea;
        }

        /* Color del botón en las tarjetas */
        .btn-outline-success {
    background-color: #28a745;
    color: white;
    border-color: #28a745;
    display: block; /* Esto hará que el botón ocupe el 100% de su contenedor */
    margin: 0 auto; /* Centrará el botón horizontalmente */
}

        .btn-outline-success:hover {
            background-color: #218838;
            border-color: #1e7e31;
        }

        .row {
    margin-bottom: 30px; /* Espacio entre las filas */
}

/* Si prefieres ajustar el margen entre las tarjetas dentro de cada columna */
.card {
    margin-bottom: 20px; /* Ajustar el espacio entre tarjetas */
}
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <img src="/img/utew.png" alt="Logo">
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <!-- Sección Cursos -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-book"></i> Cursos
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($cursos as $curso)
                                    <li>
                                        <strong>Nombre:</strong> {{ $curso->nombre }}<br>
                                        <strong>Modalidad:</strong> {{ $curso->modalidad }}<br>
                                        <strong>Nivel:</strong> {{ $curso->nivel_curso }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('cursos.index') }}" class="btn btn-link">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Sección Grupos -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-users"></i> Grupos
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($grupos as $grupo)
                                    <li>
                                        <strong>Código:</strong> {{ $grupo->codigo }}<br>
                                        <strong>Cantidad:</strong> {{ $grupo->cantidad }}<br>
                                        <strong>Docente:</strong> 
                                        @if($grupo->pofe)  
                                        {{ $grupo->pofe->nombre }}
                                        @else
                                          No asignado
                                        @endif
                                        <br>

                                        <strong>Curso:</strong> 
                                        @if($grupo->curso) 
                                        {{ $grupo->curso->nombre }}
                                        @else 
                                              No asignado 
                                        @endif
                                        <br>
                                        <strong>Periodo Académico:</strong> 
                                        @if ($grupo->periodo_academicos) 
                                            {{ $grupo->periodo_academicos->nombre }} 
                                        @else 
                                            No asignado 
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('grupos.index') }}" class="btn btn-link">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Sección Matrículas -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-clipboard-list"></i> Matrículas
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($matriculas as $matricula)
                                    <li>
                                        <strong>Nombre:</strong> {{ $matricula->student->nombre ?? 'No asignado' }}<br>
                                        <strong>Documento:</strong> {{ $matricula->student->documento ?? 'No asignado' }}<br>
                                        <strong>Estado:</strong> {{ $matricula->estado ?? 'No asignado' }}<br>
                                        <strong>Promedio:</strong> {{ $matricula->nota_final ?? 'No asignado' }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('matriculas.index') }}" class="btn btn-link">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Sección Períodos Académicos -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-calendar-alt"></i> Períodos Académicos
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($periodos as $periodo)
                                    <li>
                                        <strong>Año:</strong> {{ $periodo->año }}<br>
                                        <strong>Nombre:</strong> {{ $periodo->nombre }}<br>
                                        <strong>Periodo:</strong> {{ $periodo->periodo }}<br>
                                        <strong>Descripción:</strong> {{ $periodo->descripcion }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('periodos.index') }}" class="btn btn-link">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sección Formularios de Inscripción -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-file-alt"></i> Formularios de Inscripción
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($formularios as $formulario)
                                    <li>
                                        <strong>Nombre:</strong> {{ $formulario->name }}<br>
                                        <strong>Email:</strong> {{ $formulario->email }}<br>
                                        <strong>Documento:</strong> {{ $formulario->Documento }}<br>
                                        <strong>Estado:</strong> {{ $formulario->estado }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('formularios.index') }}" class="btn btn-link">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Sección Inscripciones -->
                <div class="col-md-3">
                <div class="card">
    <div class="card-header">
        <i class="fas fa-user-plus"></i> Inscripciones
    </div>
    <div class="card-body text-center">
        <p>Importa datos de inscripciones rápidamente.</p>
        <form action="{{ route('formularios.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-outline-primary">Importar Inscripciones</button>
</form>

        <!-- Mostrar mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
    </div>
</div>
</div>
                <!-- Sección Profesores -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chalkboard-teacher"></i> Profesores
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($profesores as $profesor)
                                    <li>
                                        <strong>Nombre:</strong> {{ $profesor->nombre }}<br>
                                        <strong>Email:</strong> {{ $profesor->email }}<br>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                        <a href="{{ route('profesores.index') }}" class="btn btn-link">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Sección Estudiantes -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-graduation-cap"></i> Estudiantes
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($estudiantes as $estudiante)
                                    <li>
                                        <strong>Nombre:</strong> {{ $estudiante->nombre }}<br>
                                        <strong>Email:</strong> {{ $estudiante->email }}<br>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('estudiantes.index') }}" class="btn btn-link">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 UTS - Todos los derechos reservados por el rompe mesas .</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>

