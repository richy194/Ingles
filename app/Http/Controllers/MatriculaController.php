<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Curso;
use App\Models\Theacher;
use App\Models\Student; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\MatriculasExport;
use App\Imports\MatriculasImport;


class MatriculaController extends Controller
{
    // Muestra todas las matrículas
    public function index(Request $request)
    {
        $query = $request->get('query');
    
        $matriculas = Matricula::with(['student', 'curso', 'teacher']) // Carga relaciones necesarias
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->whereHas('student', function ($subQuery) use ($query) {
                    $subQuery->where('nombre', 'like', '%' . $query . '%')
                             ->orWhere('documento', 'like', '%' . $query . '%');
                });
            })
            ->get();
    
        return view('matriculas.index', compact('matriculas'));
    }

    // Muestra una matrícula específica
    public function show($id)
    {
        $matricula = Matricula::with(['curso', 'teacher'])->findOrFail($id); // Incluimos relaciones
        return view('matriculas.show', compact('matricula'));
    }

    // Crea una nueva matrícula (vista para admins)
    public function create()
    {
        $this->authorize('create', Matricula::class); // Verifica permisos

        $cursos = Curso::all();
        $teachers = Theacher::all();
        $students = Student::all(); // Obtenemos los estudiantes registrados previamente
        
        return view('matriculas.create', compact('cursos', 'teachers', 'students')); // Pasamos los datos a la vista
    }

    // Guarda una nueva matrícula
    public function store(Request $request)
    {
        $this->authorize('create', Matricula::class); // Verifica permisos

        $validated = $request->validate([
            'fecha_matricula' => 'required|date',
            'estado' => 'nullable|string|max:255',
            'nota_final' => 'nullable|numeric',
            'teacher_id' => 'required|exists:theachers,id', // Valida que el teacher exista
            'grupo_id' => 'required|exists:groups,id', // Valida que el grupo exista
            'student_id' => 'required|exists:students,id',
        ]);

        Matricula::create($validated); // Creamos la matrícula
        return redirect()->route('matriculas.index')->with('success', 'Matrícula creada correctamente.');
    }

    // Edita una matrícula (vista para admins)
    public function edit($id)
    {
        $matricula = Matricula::findOrFail($id); // Encuentra la matrícula
        $cursos = Curso::all(); 
        $teachers = Theacher::all();
        $students = Student::all(); // Obtenemos los estudiantes registrados previamente
        
        return view('matriculas.edit', compact('matricula', 'cursos', 'teachers', 'students'));
    }

    // Actualiza una matrícula
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id', // Validamos el estudiante relacionado
            'fecha_matricula' => 'required|date',
            'estado' => 'nullable|string|max:255',
            'nota_final' => 'nullable|numeric',
            'teacher_id' => 'required|exists:theachers,id',
            'grupo_id' => 'required|exists:groups,id',
        ]);

        $matricula = Matricula::findOrFail($id);
        $matricula->update($validated);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula actualizada correctamente.');
    }

    // Elimina una matrícula
    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', 'Matrícula eliminada correctamente.');
    }

    // Exporta las matrículas a un archivo Excel
    public function export() 
    {
        return Excel::download(new MatriculasExport, 'matriculas.xlsx'); // Exporta como archivo Excel
    }

    // Importa matrículas desde un archivo Excel
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv'
    ]);

    Excel::import(new MatriculasImport, $request->file('file'));

    return back()->with('success', 'Matrículas importadas exitosamente.');
}




    // Método para obtener los datos del estudiante
    public function getStudentDataForMatricula($id)
    {
        // Encuentra al estudiante por ID
        $student = Student::findOrFail($id);

        // Devuelve los datos del estudiante en formato JSON
        return response()->json([
            'nombre' => $student->nombre,
            'email' => $student->email,
            'documento' => $student->Documento,
            'direccion' => $student->direccion,
            'telefono' => $student->telefono
        ]);
    }

    public function destroyMultiple(Request $request)
    {
        // Validar que se han enviado IDs
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:students,id',
        ]);
    
        // Eliminar los estudiantes seleccionados
        Matricula::whereIn('id', $request->ids)->delete();
    
        return redirect()->route('matriculas.index')->with('success', 'matriculas  eliminados correctamente.');
    }
}
