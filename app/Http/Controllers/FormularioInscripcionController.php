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
            'name' => 'required|string|max:255', // El nombre es obligatorio, debe ser texto y tiene un máximo de 255 caracteres.
    'email' => 'nullable|email|max:255', // El correo es opcional, debe ser un correo válido con un máximo de 255 caracteres.
    'Documento' => 'required|string|max:255', // El documento es obligatorio, debe ser texto y tiene un máximo de 255 caracteres.
    'direccion' => 'required|string|max:255', // La dirección es obligatoria, debe ser texto y tiene un máximo de 255 caracteres.
    'telefono' => 'nullable|string|max:255', // El teléfono es opcional, debe ser texto y tiene un máximo de 255 caracteres.
    'fecha_matricula' => 'required|date', // La fecha de matrícula es obligatoria y debe ser una fecha válida.
    'estado' => 'nullable|in:aprobado,desaprobado,cancelado,no aprobado', // El estado es obligatorio y debe ser "activo" o "inactivo".
    'nota_final' => 'nullable|numeric|min:0|max:100', // La nota final es opcional, debe ser numérica y estar entre 0 y 100.
    'teacher_id' => 'required|exists:theachers,id', // El ID del profesor es obligatorio y debe existir en la tabla "theachers".
    'grupo_id' => 'nullable|exists:cursos,id', //
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
