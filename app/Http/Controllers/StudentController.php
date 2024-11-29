<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Muestra todos los estudiantes
    public function index()
    {
        $estudiantes = Student::all(); // Obtén todos los estudiantes
        return view('estudiantes.index', compact('estudiantes')); // Pasa los estudiantes a la vista
    }

    // Muestra un estudiante específico
    public function show($id)
    {
        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        return view('estudiantes.show', compact('estudiante')); // Muestra la vista para ver al estudiante
    }

    // Crea un nuevo estudiante (solo para admins)
    public function create()
    {
        return view('estudiantes.create'); // Muestra la vista para crear un nuevo estudiante
    }

    // Guarda un nuevo estudiante
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'Documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        Student::create($validated); // Crea el estudiante
        return redirect()->route('estudiantes.index'); // Redirige al índice de estudiantes
    }

    // Edita un estudiante
    public function edit($id)
    {
        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        return view('estudiantes.edit', compact('estudiante')); // Muestra la vista para editar al estudiante
    }

    // Actualiza un estudiante
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'Documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        $estudiante->update($validated); // Actualiza los campos
        return redirect()->route('estudiantes.index'); // Redirige al índice de estudiantes
    }

    // Elimina un estudiante
    public function destroy($id)
    {
        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        $estudiante->delete(); // Elimina al estudiante
        return redirect()->route('estudiantes.index'); // Redirige al índice de estudiantes
    }

}
