<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Semestre;
use App\Models\Theacher;
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
        // Solo los administradores pueden crear cursos
        $this->authorize('create', Curso::class);

        // Obtener todos los semestres y docentes para los campos select
        $semestres = Semestre::all();
        $teachers = Theacher::all();

        return view('cursos.create', compact('semestres', 'teachers'));
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
            'semestre_id' => 'required|exists:semestres,id',
            'teacher_id' => 'required|exists:theachers,id',
        ]);

        // Crear el curso con los datos validados
        Curso::create($validated);
        return redirect()->route('cursos.index');
    }

    // Mostrar el formulario para editar un curso
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        $this->authorize('update', $curso); // Solo el dueño o un admin puede editar
        
        // Obtener todos los semestres y docentes para los campos select
        $semestres = Semestre::all();
        $teachers = Theacher::all();

        return view('cursos.edit', compact('curso', 'semestres', 'teachers'));
    }

    // Actualizar un curso
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'codigo' => 'required|string',
            'descripcion' => 'required|string',
            'nivel_curso' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'requisito' => 'required|string',
            'modalidad' => 'required|string',
            'semestre_id' => 'required|exists:semestres,id',
            'teacher_id' => 'required|exists:theachers,id',
        ]);

        $curso = Curso::findOrFail($id);
        $curso->update($validated);
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
