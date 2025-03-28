<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Grupos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            font-size: 1.8rem;
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-regresar {
            background-color: #28a745;
        }

        .btn-regresar:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .acciones {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Lista de Grupos</h3>
            <div>
                <a href="/dashboard" class="btn btn-regresar">Regresar</a>
                @can('create', App\Models\Group::class)
                    <a href="{{ route('grupos.create') }}" class="btn btn-primary ms-2">Crear Grupo</a>
                @endcan
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Grupo</th>
                        <th>Código Grupo</th>
                        <th>Nombre</th>
        
                        <th>Profesor</th>
                        <th>Cantidad</th>
                        <th>Horario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grupos as $group)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $group->curso->nombre?? 'No asignado' }}</td>
                            <td>{{ $group->curso->codigo?? 'No asignado' }}</td>
                            <td>{{ $group->nombre?? 'No asignado' }}</td>
        
                            <td>{{ $group->pofe->nombre ?? 'No asignado' }}</td>
                            <td>{{ $group->cantidad?? 'No asignado' }}</td>
                            <td>
    @if (!is_null($group->horario) && is_array(json_decode($group->horario)))
        @foreach (json_decode($group->horario) as $horario)
            <p>Día: {{ $horario->dia }}, Hora: {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</p>
        @endforeach
    @else
        <p>No hay horarios asignados</p>
    @endif
</td>
                            <td class="acciones">
                                @can('view', $group)
                                    <a href="{{ route('grupos.show', $group->id) }}" class="btn btn-primary">Ver</a>
                                @endcan
                                @can('update', $group)
                                    <a href="{{ route('grupos.edit', $group->id) }}" class="btn btn-warning">Editar</a>
                                @endcan
                                @can('delete', $group)
                                    <form action="{{ route('grupos.destroy', $group->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este grupo?')">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No hay grupos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
