<?
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
    public function index()
    {
        $cursos = Curso::all(); // Obtiene todos los cursos
        return view('cursos.index', compact('cursos'));
    }

    // Mostrar un curso específico
    public function show($id)
    {
        $curso = Curso::findOrFail($id); // Encuentra el curso por ID
        return view('cursos.show', compact('curso'));
    }

    // Mostrar el formulario para crear un nuevo curso
    public function create()
    {
        $this->authorize('create', Curso::class); // Asegura que el usuario tenga permiso de crear cursos

        // Obtener todos los semestres, docentes y grupos para los campos select
        $periodos = PeriodoAcademico::all();
        $teachers = Theacher::all();
        $grupos = Group::all(); // Obtener todos los grupos

        return view('cursos.create', compact('periodos', 'teachers', 'grupos'));
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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'requisito' => 'required|string',
            'modalidad' => 'required|string',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'teacher_id' => 'required|exists:theachers,id',
            'grupo_id' => 'required|array|min:1',
            'grupo_id.*' => 'exists:groups,id',  // Asegurándonos de que los IDs son válidos
        ]);

        // Crear el curso con los datos validados
        $curso = Curso::create($validated);

        // Asociar los grupos seleccionados al curso
        $grupoIds = $request->grupo_id;  // Obtener los IDs de los grupos seleccionados
        foreach ($grupoIds as $grupoId) {
            $grupo = Group::find($grupoId);
            $curso->grupos()->save($grupo);  // Asociar cada grupo al curso
        }

        return redirect()->route('cursos.index');
    }

    // Mostrar el formulario para editar un curso
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        $this->authorize('update', $curso); // Solo el dueño o un admin puede editar

        // Obtener todos los semestres, docentes y grupos para los campos select
        $periodos = PeriodoAcademico::all();
        $teachers = Theacher::all();
        $grupos = Group::all(); // Obtener todos los grupos

        return view('cursos.edit', compact('curso', 'periodos', 'teachers', 'grupos'));
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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'requisito' => 'required|string',
            'modalidad' => 'required|string',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'teacher_id' => 'required|exists:theachers,id',
            'grupo_id' => 'required|array|min:1',
            'grupo_id.*' => 'exists:groups,id',  // Asegurándonos de que los IDs son válidos
        ]);

        // Buscar el curso por ID
    // Buscar el curso
    $curso = Curso::findOrFail($id);

    // Actualizar los datos del curso
    $curso->update($validated);

    $grupoIds = $request->grupo_id;  // Obtener los IDs de los grupos seleccionados
    foreach ($grupoIds as $grupoId) {
        $grupo = Group::find($grupoId);
        $curso->grupos()->save($grupo);  // Asociar cada grupo al curso
    }

    return redirect()->route('cursos.index');
}

    // Eliminar un curso
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $this->authorize('delete', $curso); // Solo los admins pueden eliminar
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
