<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Período Académico</title>
    <link rel="icon" type="image/png" href="{{ asset('img/uteis.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&family=Sora:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modern-admin.css') }}">
</head>
<body>
    <div class="page-shell">
        <section class="hero">
            <div>
                <h1>Crear Nuevo Período Académico</h1>
                <p>Registra un nuevo período en el sistema.</p>
            </div>
            <div class="actions">
                <a href="{{ route('periodos.index') }}" class="btn btn-neutral">Cancelar</a>
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Por favor revisa los errores:</strong>
                        <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('periodos.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="año">Año <span class="required">*</span></label>
                            <input type="number" name="año" id="año" class="form-control" value="{{ old('año') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre <span class="required">*</span></label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="periodo">Tipo de Período <span class="required">*</span></label>
                            <select name="periodo" id="periodo" class="form-control" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="SEMESTRE-1" {{ old('periodo') == 'SEMESTRE-1' ? 'selected' : '' }}>SEMESTRE-1</option>
                                <option value="SEMESTRE-2" {{ old('periodo') == 'SEMESTRE-2' ? 'selected' : '' }}>SEMESTRE-2</option>
                                <option value="TRIMESTRE-1" {{ old('periodo') == 'TRIMESTRE-1' ? 'selected' : '' }}>TRIMESTRE-1</option>
                                <option value="TRIMESTRE-2" {{ old('periodo') == 'TRIMESTRE-2' ? 'selected' : '' }}>TRIMESTRE-2</option>
                                <option value="TRIMESTRE-3" {{ old('periodo') == 'TRIMESTRE-3' ? 'selected' : '' }}>TRIMESTRE-3</option>
                                <option value="TRIMESTRE-4" {{ old('periodo') == 'TRIMESTRE-4' ? 'selected' : '' }}>TRIMESTRE-4</option>
                                <option value="TRIMESTRE-5" {{ old('periodo') == 'TRIMESTRE-5' ? 'selected' : '' }}>TRIMESTRE-5</option>
                                <option value="TRIMESTRE-6" {{ old('periodo') == 'TRIMESTRE-6' ? 'selected' : '' }}>TRIMESTRE-6</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-brand">Crear Período</button>
                        <a href="{{ route('periodos.index') }}" class="btn btn-neutral">Cancelar</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
