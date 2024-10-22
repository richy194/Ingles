<?php

namespace App\Http\Controllers;

use App\Models\FormularioInscripcion;
use App\Models\Role; 
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
        $roles = Role::all();

        // Mostrar la vista con los roles
        return view('inscripcion', compact('roles'));
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
            'password' => 'required|string|min:8',
            'Documento' => 'required|string|max:255|unique:formulario_inscripcions',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id', // Asegurarse de que el rol existe
        ]);

        // Crear el nuevo registro en la base de datos
        FormularioInscripcion::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Encriptar la contraseña
            'Documento' => $validatedData['Documento'],
            'direccion' => $validatedData['direccion'],
            'telefono' => $validatedData['telefono'],
            'role_id' => $validatedData['role_id'],
        ]);

        // Redirigir al listado del recurso en Filament
        return redirect()->route('filament.admin.resources.formulario-inscripcions.index')
                         ->with('success', 'Registro creado exitosamente.');
    }
}
