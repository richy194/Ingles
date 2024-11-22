<?php

namespace App\Http\Controllers;

use App\Models\FormularioInscripcion;

use App\Models\Theacher;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FormularioInscripcionController extends Controller
{
    /**
     * Muestra el formulario de inscripción.
     */
    public function create()
    {
        // Obtener los roles para mostrarlos en el select (si es necesario)
       
        $teachers = \App\Models\Theacher::all();
        $grupos =   \App\Models\Curso::all();

        // Mostrar la vista con los roles
        return view('inscripcion', compact( 'teachers', 'grupos'));
    }

    /**
     * Guarda los datos enviados por el formulario.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'Documento' => 'required|string|max:255|unique:formulario_inscripcions',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|in:activo,inactivo',
            'nota_final' => 'nullable|numeric|min:0|max:100',
            'teacher_id' => 'required|exists:theachers,id',
            'grupo_id' => 'nullable|exists:cursos,id',
        ]);

        // Crear el nuevo registro en la base de datos
        FormularioInscripcion::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'Documento' => $validatedData['Documento'],
            'direccion' => $validatedData['direccion'],
            'telefono' => $validatedData['telefono'],
            'fecha_matricula' => $validatedData['fecha_matricula'], // Asegúrate de que la fecha es válida
            'estado' => $validatedData['estado'],
            'nota_final' => $validatedData['nota_final'],
            'teacher_id' => $validatedData['teacher_id'],
            'grupo_id' => $validatedData['grupo_id'],
        ]);

        // Redirigir al listado del recurso en Filament
        return redirect()->route('dashboard')
                         ->with('success', 'Registro creado exitosamente.');
    }
}
