<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Curso;
use App\Models\Theacher;
use App\Models\PeriodoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GrupoController extends Controller
{
    // Mostrar todos los grupos
    public function index()
    {
        $user = Auth::user();
    
        if ($user->hasRole('docente')) {
            // Buscar el docente por el email del usuario autenticado
            $teacher = Theacher::where('email', $user->email)->first();
    
            if ($teacher) {
                $grupos = Group::with(['curso', 'periodo_academicos'])
                    ->where('teacher_id', $teacher->id)
                    ->get();
            } else {
                // Si no hay docente asociado al correo, devolver colección vacía
                $grupos = collect();
            }
        } else {
            $grupos = Group::with(['curso', 'periodo_academicos'])->get();
        }
    
        return view('grupos.index', compact('grupos'));
    }
    

    // Mostrar un grupo específico
    public function show($id)
    {
        $grupo = Group::with(['curso', 'periodo_academicos'])->findOrFail($id);
        return view('grupos.show', compact('grupo'));
    }

    // Formulario para crear un nuevo grupo
    public function create()
    {
        $cursos = Curso::all();
        $periodos = PeriodoAcademico::all();
        $teachers = Theacher::all();
        return view('grupos.create', compact('cursos', 'periodos', 'teachers'));
    }

    // Guardar un nuevo grupo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'horario' => 'required|array', // Validar que sea un array
            'horario.*.dia' => 'required|string', // Cada elemento debe tener un día
            'horario.*.hora_inicio' => 'required|date_format:H:i',
            'horario.*.hora_fin' => 'required|date_format:H:i|after:horarios.*.hora_inicio',
            'nombre' => 'required|string|max:100|unique:groups,nombre',
            'curso_id' => 'nullable|exists:cursos,id',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'cantidad' => 'required|integer|min:1',
            'teacher_id' => 'required|exists:theachers,id',
        ]);

        $validated['horario'] = json_encode($validated['horario']); // Convertir a JSON para almacenar

        Group::create($validated);
        return redirect()->route('grupos.index');
    }

    // Formulario para editar un grupo
    public function edit($id)
{
    $grupo = Group::findOrFail($id);
    $grupo->horario = json_decode($grupo->horario, true); // Convertir JSON a array para edición

    $cursos = Curso::all();
    $periodos = PeriodoAcademico::all();
    $teachers = Theacher::all();

    // Define $horarios para pasarlo a la vista
    $horarios = $grupo->horario ?? []; // Si no hay horarios, usa un array vacío

    return view('grupos.edit', compact('grupo', 'cursos', 'periodos', 'teachers', 'horarios'));
}

    // Actualizar un grupo
    public function update(Request $request, $id)
    {
        $grupo = Group::findOrFail($id);

        $validated = $request->validate([
            'horario' => 'required|array',
            'horario.*.dia' => 'required|string',
            'horario.*.hora_inicio' => 'required|date_format:H:i',
            'horario.*.hora_fin' => 'required|date_format:H:i|after:horarios.*.hora_inicio',
            'nombre' => 'required|string|max:100|unique:groups,nombre,' . $id,
            'curso_id' => 'nullable|exists:cursos,id',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'cantidad' => 'required|integer|min:1',
            'teacher_id' => 'required|exists:theachers,id',
        ]);

        $validated['horario'] = json_encode($validated['horario']); // Convertir a JSON para actualizar

        $grupo->update($validated);
        return redirect()->route('grupos.index');
    }

    // Eliminar un grupo
    public function destroy($id)
    {
        $grupo = Group::findOrFail($id);
        $grupo->delete();
        return redirect()->route('grupos.index');
    }
}
