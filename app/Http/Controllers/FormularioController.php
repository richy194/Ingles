<?php

namespace App\Http\Controllers;

use App\Models\FormularioInscripcion;
use App\Http\Requests\FormularioInscripcionRequest;
use App\Models\User;
use App\Models\Matricula;
use App\Models\Theacher;
use App\Models\Curso;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FormularioController extends Controller
{
    public function index()
    {
        $formularios = FormularioInscripcion::with(['teacher', 'curso'])->get();
        $teachers = Theacher::all();
        $grupos = Group::all();
        return view('formularios.index', compact('formularios', 'teachers', 'grupos'));
    }


    public function show($id)
    {
        $formulario = FormularioInscripcion::with(['curso', 'teacher'])->findOrFail($id); // Encuentra la matrícula por ID con las relaciones
        return view('formularios.show', compact('formulario')); // Muestra la vista para ver la matrícula
    }

    public function create()
    {
        $teachers = Theacher::all();
        $cursos = Curso::all();
        return view('formularios.create', compact('teachers', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:formulario_inscripcions,email',
            'Documento' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'fecha_matricula' => 'nullable|date',
            'estado' => 'required|string|max:50',
            'nota_final' => 'nullable|numeric|min:0|max:100',
            'teacher_id' => 'nullable|exists:theachers,id',
            'grupo_id' => 'nullable|exists:cursos,id',
        ]);

        FormularioInscripcion::create($request->all());

        return redirect()->route('formularios.index')->with('success', 'Formulario creado correctamente.');
    }

    public function edit(FormularioInscripcion $formulario)
    {
        $teachers = Theacher::all();
        $cursos = Curso::all();
        return view('formularios.edit', compact('formulario', 'teachers', 'cursos'));
    }

    public function update(Request $request, FormularioInscripcion $formulario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:formulario_inscripcions,email,' . $formulario->id,
            'Documento' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'fecha_matricula' => 'nullable|date',
            'estado' => 'required|string|max:50',
            'nota_final' => 'nullable|numeric|min:0|max:100',
            'teacher_id' => 'nullable|exists:theachers,id',
            'grupo_id' => 'nullable|exists:cursos,id',
        ]);

        $formulario->update($request->all());

        return redirect()->route('formularios.index')->with('success', 'Formulario actualizado correctamente.');
    }


    public function inscribir(FormularioInscripcion $formulario)
{
    // Crear la matrícula utilizando el formulario
    Matricula::create([
        'name' => $formulario->name,  
        'email' => $formulario->email,
        'Documento' => $formulario->Documento,
        'direccion' => $formulario->direccion,
        'telefono' => $formulario->telefono,
        'fecha_matricula' => $formulario->fecha_matricula,
        'estado' => $formulario->estado,
        'nota_final' => $formulario->nota_final,
        'teacher_id' => $formulario->teacher_id, 
        'grupo_id' => $formulario->grupo_id,
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('formularios.index')->with('success', 'Matrícula creada correctamente.');
}

public function destroy($id)
    {
        
        $formulario = FormularioInscripcion::findOrFail($id); // Encuentra la matrícula por ID
        $formulario->delete(); // Elimina la matrícula
        return redirect()->route('formularios.index'); // Redirige al índice de matrículas
    }





    
    
}















