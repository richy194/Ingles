<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\PeriodoAcademico;
use App\Models\Theacher;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    // Constructor para asegurarse de que solo los usuarios autenticados accedan
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todos los cursos
   // Mostrar todos los cursos
   public function index()
{
    $user = Auth::user();

    if ($user->hasRole('docente')) {
        // Buscar el ID del docente usando el correo del usuario
        $teacher = Theacher::where('email', $user->email)->first();

        if (!$teacher) {
            $cursos = collect(); // Si no hay docente con ese correo, devolver vacío
        } else {
            // Obtener cursos donde el docente tenga al menos un grupo
            $cursos = Curso::whereHas('grupos', function ($query) use ($teacher) {
                    $query->where('teacher_id', $teacher->id);
                })
                ->with(['grupos' => function ($query) use ($teacher) {
                    $query->where('teacher_id', $teacher->id);
                }])
                ->get();
        }
    } else {
        // Para admin u otros roles: mostrar todos los cursos con todos los grupos
        $cursos = Curso::with('grupos')->get();
    }

    return view('cursos.index', compact('cursos'));
}

   


    // Mostrar un curso específico
    public function show($id)
    {
        // Cargar curso con relación a los grupos y profesores
        $curso = Curso::with(['grupos.pofe'])->findOrFail($id);

        return view('cursos.show', compact('curso'));
    }

    // Mostrar el formulario para crear un nuevo curso
    public function create()
    {
        $this->authorize('create', Curso::class); // Asegura que el usuario tenga permiso de crear cursos

        // Obtener todos los semestres, docentes, grupos y cursos para los campos select
        $periodos = PeriodoAcademico::all();
        $teachers = Theacher::all();
        $grupos = Group::all(); // Obtener todos los grupos
        $cursos = Curso::all(); // Obtener todos los cursos disponibles para los requisitos

        return view('cursos.create', compact('periodos', 'teachers', 'grupos', 'cursos'));
    }

    // Guardar un nuevo curso
    public function store(Request $request)
    {
        // Validación de la entrada
        $validated = $request->validate([
            'nombre' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'required|string',
            'nivel_curso' => 'required|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'requisito' => 'nullable|exists:cursos,id',  // El requisito puede ser un curso existente o nulo
            'modalidad' => 'required|string',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'teacher_id' => 'nullable|exists:theachers,id',
            'grupo_id.*' => 'exists:groups,id',  // Asegurándonos de que los IDs de grupos son válidos
        ]);

        // Crear el curso con los datos validados
        $curso = Curso::create($validated);

        // Asociar los grupos seleccionados al curso
        if ($request->has('grupo_id') && !empty($request->grupo_id)) {
            $grupoIds = $request->grupo_id;
            foreach ($grupoIds as $grupoId) {
                $grupo = Group::find($grupoId);
                $curso->grupos()->save($grupo);  // Asociar cada grupo al curso
            }
        }

        return redirect()->route('cursos.index');
    }

    // Mostrar el formulario para editar un curso
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        $this->authorize('update', $curso); // Solo el dueño o un admin puede editar

        // Obtener todos los semestres, docentes, grupos y cursos para los campos select
        $periodos = PeriodoAcademico::all();
        $teachers = Theacher::all();
        $grupos = Group::all(); // Obtener todos los grupos
        $cursos = Curso::all(); // Obtener todos los cursos disponibles para los requisitos

        return view('cursos.edit', compact('curso', 'periodos', 'teachers', 'grupos', 'cursos'));
    }

    // Actualizar un curso
    public function update(Request $request, $id)
    {
        // Validación de la entrada
        $validated = $request->validate([
            'nombre' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'required|string',
            'nivel_curso' => 'required|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'requisito' => 'nullable|exists:cursos,id', // Si es un requisito, puede ser otro curso o nulo
            'modalidad' => 'required|string',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'teacher_id' => 'nullable|exists:theachers,id',
            'grupo_id.*' => 'exists:groups,id',  // Asegurándonos de que los IDs de grupos son válidos
        ]);

        // Buscar el curso
        $curso = Curso::findOrFail($id);

        // Actualizar los datos del curso
        $curso->update($validated);

        // Asociar los grupos seleccionados al curso
        if ($request->has('grupo_id') && !empty($request->grupo_id)) {
            $grupoIds = $request->grupo_id;
            foreach ($grupoIds as $grupoId) {
                $grupo = Group::find($grupoId);
                $curso->grupos()->save($grupo);  // Asociar cada grupo al curso
            }
        }

        return redirect()->route('cursos.index');
    }

    // Eliminar un curso
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $this->authorize('delete', $curso); // Solo los admins pueden eliminar

        // Eliminar el curso
        $curso->delete();

        return redirect()->route('cursos.index');
    }
}
