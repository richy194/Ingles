<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Curso;
use App\Models\Theacher;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MatriculasExport;
use App\Imports\MatriculasImport;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    // Muestra todas las matrículas
    public function index()
    {
        $matriculas = Matricula::with(['curso', 'teacher'])->get(); // Obtén todas las matrículas con las relaciones de curso y teacher
        return view('matriculas.index', compact('matriculas')); // Pasa las matrículas a la vista
    }

    // Muestra una matrícula específica
    public function show($id)
    {
        $matricula = Matricula::with(['curso', 'teacher'])->findOrFail($id); // Encuentra la matrícula por ID con las relaciones
        return view('matriculas.show', compact('matricula')); // Muestra la vista para ver la matrícula
    }

    // Crea una nueva matrícula (solo para admins)
    public function create()
    {
        $this->authorize('create', Matricula::class); // Verifica que el usuario tenga permisos

        // Obtén los cursos y profesores para la creación
        $cursos = Curso::all();
        $teachers = Theacher::all();
        
        return view('matriculas.create', compact('cursos', 'teachers')); // Pasa cursos y profesores a la vista
    }

    // Guarda una nueva matrícula
    public function store(Request $request)
    {
        $this->authorize('create', Matricula::class); // Verifica que el usuario tenga permisos

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'Documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|string|max:255',
            'nota_final' => 'nullable|numeric',
            'teacher_id' => 'required|exists:theachers,id', // Asegura que el teacher exista
            'grupo_id' => 'required|exists:groups,id', // Asegura que el grupo exista
        ]);

        Matricula::create($validated); // Crea la matrícula
        return redirect()->route('matriculas.index'); // Redirige al índice de matrículas
    }

    // Edita una matrícula (solo para admins)
    public function edit($id)
    {
        
        $matricula = Matricula::findOrFail($id); // Encuentra la matrícula por ID
        $cursos = Curso::all(); // Obtén todos los cursos
        $teachers = Theacher::all(); // Obtén todos los profesores
        
        return view('matriculas.edit', compact('matricula', 'cursos', 'teachers')); // Muestra la vista para editar la matrícula
    }

    // Actualiza una matrícula
    public function update(Request $request, $id)
    {
        

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'Documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|string|max:255',
            'nota_final' => 'nullable|numeric',
            'teacher_id' => 'required|exists:theachers,id', // Asegura que el teacher exista
            'grupo_id' => 'required|exists:groups,id', // Asegura que el grupo exista
        ]);

        $matricula = Matricula::findOrFail($id); // Encuentra la matrícula por ID
        $matricula->update($validated); // Actualiza los campos
        return redirect()->route('matriculas.index'); // Redirige al índice de matrículas
    }

    // Elimina una matrícula (solo para admins)
    public function destroy($id)
    {
        
        $matricula = Matricula::findOrFail($id); // Encuentra la matrícula por ID
        $matricula->delete(); // Elimina la matrícula
        return redirect()->route('matriculas.index'); // Redirige al índice de matrículas
    }

    public function export()
{
    try {
        return Excel::download(new MatriculasExport, 'matriculas.xlsx');
    } catch (\Exception $e) {
        return back()->with('error', 'Error al exportar los datos: ' . $e->getMessage());
    }
}


    public function import(Request $request)
{
    // Validar que el archivo sea un archivo Excel
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls',  // Se valida que sea un archivo .xlsx o .xls
    ]);

    try {
        // Importar los datos del archivo
        Excel::import(new MatriculasImport, $request->file('file'));
        return redirect()->route('matriculas.index')->with('success', 'Matrículas importadas correctamente.');
    } catch (\Exception $e) {
        return redirect()->route('matriculas.index')->with('error', 'Error al importar los datos: ' . $e->getMessage());
    }
}
}