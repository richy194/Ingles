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
       

        $cursos = Curso::all();
        $teachers = Theacher::all();
        $students = Student::all(); // Obtenemos los estudiantes registrados previamente
        
        return view('matriculas.create', compact('cursos', 'teachers', 'students')); // Pasamos los datos a la vista
    }

    // Guarda una nueva matrícula
    public function store(Request $request)
    {
       

        // Llama a la lógica centralizada para matricular al estudiante
        return $this->matricularEstudiante($request->student_id, $request->grupo_id);

        $validated = $request->validate([
            'fecha_matricula' => 'required|date',
            'estado' => 'nullable|string|max:255',
            'nota_final' => 'nullable|numeric',
            'teacher_id' => 'required|exists:theachers,id', // Valida que el teacher exista
            'grupo_id' => 'required|exists:cursos,id', // Valida que el grupo exista
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
            'grupo_id' => 'required|exists:cursos,id',
        ]);

       

        // Encuentra la matrícula existente
        $matricula = Matricula::findOrFail($id);
        
        $this->matricularEstudiante($request->student_id, $request->grupo_id, $matricula);
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

    $import = new MatriculasImport;
    Excel::import($import, $request->file('file'));

    // Validar requisitos para cada matrícula importada
    foreach ($import->getMatriculas() as $matricula) {
        // Llamamos al método matricularEstudiante para hacer la validación de los requisitos
        $response = $this->matricularEstudiante($matricula['student_id'], $matricula['grupo_id'], null);
        
        if (isset($response->original['error'])) {
            // Si hay error, se puede marcar la matrícula como inválida o eliminarla
            // También podrías guardar un log del error o mostrarlo de alguna manera
            // Para este ejemplo, lo marcaré en un mensaje.
            return back()->with('error', $response->original['error']);
        }
    }

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


    public function matricularEstudiante($estudianteId, $cursoId, $matricula = null)
{
    // Obtener el curso actual y el estudiante
    $curso = Curso::findOrFail($cursoId);
    $estudiante = Student::findOrFail($estudianteId); // Obtener el estudiante

    // Verificar si el curso tiene un requisito
    if ($curso->requisito) {
        $cursoRequisito = Curso::find($curso->requisito);

        if (!$cursoRequisito) {
            return redirect()->back()->with('error', 'El curso requerido no existe en el sistema.');
        }

        // Verificar si el estudiante completó el curso requerido
        $matriculaRequisito = Matricula::where('student_id', $estudianteId)
            ->where('grupo_id', $cursoRequisito->id)
            ->where('estado', 'Aprobado')
            ->first();

        if (!$matriculaRequisito) {
            return redirect()->back()->with('error', "No puedes matricular al estudiante: {$estudiante->nombre} en el curso de {$curso->nombre}. Debe completar primero el curso requerido {$cursoRequisito->nombre}.");
        }
    }

    // Verificar si el estudiante ya está matriculado en este curso
    $matriculaExistente = Matricula::where('student_id', $estudianteId)
        ->where('grupo_id', $cursoId)
        ->first();

    if ($matriculaExistente && (!$matricula || $matriculaExistente->id !== $matricula->id)) {
        return redirect()->back()->with('error', "El estudiante {$estudiante->nombre} ya está matriculado en el curso: {$curso->nombre}.");
    }

    // Obtener el docente asignado al curso
    $teacherId = $curso->teacher_id;

    // Crear o actualizar matrícula
    $data = [
        'student_id' => $estudianteId,
        'grupo_id' => $cursoId,
        'teacher_id' => $teacherId,
        'fecha_matricula' => now(),
        'estado' => request()->input('estado', $matricula ? $matricula->estado : 'en progreso'),
        'nota_final' => request()->input('nota_final', $matricula ? $matricula->nota_final : null),
    ];

    if ($matricula) {
        $matricula->update($data);
    } else {
        Matricula::create($data);
    }

    return redirect()->route('matriculas.index')->with('success', "El estudiante {$estudiante->nombre} se ha matriculado con éxito en el curso: {$curso->nombre}.");
}

    


}
