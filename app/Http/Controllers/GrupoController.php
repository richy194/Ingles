<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Curso;
use App\Models\Theacher;
use App\Models\PeriodoAcademico;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    // Mostrar todos los grupos
    public function index()
    {
        $grupos = Group::with(['curso', 'periodo_academicos'])->get();
        return view('grupos.index', compact('grupos'));
    }

    // Mostrar un grupo específico
    public function show($id)
    {
        $grupo = Group::with(['curso', 'periodo_academicos'])->findOrFail($id);
        return view('grupos.show', compact('grupo'));
    }

    // Formulario para crear un nuevo grupo
    public function create()
    {
        $cursos = Curso::all();
        $periodos = PeriodoAcademico::all();
        $teachers = Theacher::all();
        return view('grupos.create', compact('cursos', 'periodos','profesores'));
    }

    // Guardar un nuevo grupo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|unique:groups,codigo',
            'curso_id' => 'required|exists:cursos,id',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'cantidad' => 'required|integer|min:1',
            'teacher_id' => 'required|exists:theachers,id',
        ]);

        Group::create($validated);
        return redirect()->route('grupos.index');
    }

    // Formulario para editar un grupo
    public function edit($id)
    {
        $grupo = Group::findOrFail($id);
        $cursos = Curso::all();
        $periodos = PeriodoAcademico::all();
        $teachers = Theacher::all();
        return view('grupos.edit', compact('grupo', 'cursos', 'periodos','teachers'));
    }

    // Actualizar un grupo
    public function update(Request $request, $id)
    {
        $grupo = Group::findOrFail($id);

        $validated = $request->validate([
            'codigo' => "required|string|unique:groups,codigo,$id",
            'curso_id' => 'required|exists:cursos,id',
            'periodo_id' => 'required|exists:periodo_academicos,id',
            'cantidad' => 'required|integer|min:1',
            'teacher_id' => 'required|exists:theachers,id',
        ]);

        $grupo->update($validated);
        return redirect()->route('grupos.index');
    }

    // Eliminar un grupo
    public function destroy($id)
    {
        $grupo = Group::findOrFail($id);
        $grupo->delete();
        return redirect()->route('grupos.index');
    }
}
