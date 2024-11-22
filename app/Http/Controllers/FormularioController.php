<?php

namespace App\Http\Controllers;

use App\Models\FormularioInscripcion;
use App\Models\Theacher;
use App\Models\Curso;
use Illuminate\Http\Request;

class FormularioInscripcionController extends Controller
{
    public function index()
    {
        $formularios = FormularioInscripcion::with(['teacher', 'curso'])->get();
        return view('formularios.index', compact('formularios'));
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
            'email' => 'required|email|unique:formulario_inscripcions,email',
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
            'email' => 'required|email|unique:formulario_inscripcions,email,' . $formulario->id,
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
}
