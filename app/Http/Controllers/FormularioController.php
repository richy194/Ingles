<?php

namespace App\Http\Controllers;

use App\Models\FormularioInscripcion;
use App\Models\Student;
use App\Models\Matricula;
use App\Models\Theacher;
use App\Models\Curso;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $formulario = FormularioInscripcion::with(['curso', 'teacher'])->findOrFail($id);
        return view('formularios.show', compact('formulario'));
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
            'Documento' => 'required|string|max:255|unique:formulario_inscripcions,Documento',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'fecha_matricula' => 'nullable|date',
            'estado' => 'nullable|string|max:255',
            'nota_final' => 'nullable|numeric|min:0|max:100',
            'teacher_id' => 'nullable|exists:theachers,id',
            'grupo_id' => 'nullable|exists:cursos,id',  // Se asume que `groups` es la tabla correcta
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
            'Documento' => 'required|string|max:255|unique:formulario_inscripcions,Documento,' . $formulario->id,
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'fecha_matricula' => 'nullable|date',
            'estado' => 'nullable|string|max:255',
            'nota_final' => 'nullable|numeric|min:0|max:100',
            'teacher_id' => 'nullable|exists:theachers,id',
            'grupo_id' => 'nullable|exists:cursos,id',
        ]);

        $formulario->update($request->all());

        return redirect()->route('formularios.index')->with('success', 'Formulario actualizado correctamente.');
    }

    public function inscribir($id)
{
    DB::beginTransaction();

    try {
        // Buscar el formulario por ID
        $formulario = FormularioInscripcion::find($id);

        if (!$formulario) {
            return redirect()->route('formularios.index')->with('error', 'El formulario no fue encontrado.');
        }

        // Imprime el contenido del formulario para depuración
        Log::info('Datos del formulario:', $formulario->toArray());

        // Crear o encontrar al estudiante
        $student = Student::firstOrCreate(
            ['documento' => $formulario->Documento],
            [
                'nombre' => $formulario->name,
                'email' => $formulario->email,
                'direccion' => $formulario->direccion,
                'telefono' => $formulario->telefono,
            ]
        );

        Log::info('Estudiante creado o encontrado:', $student->toArray());

        // Crear matrícula asociada al estudiante
        $matricula = $student->matriculas()->create([
            'fecha_matricula' => $formulario->fecha_matricula,
            'estado' => $formulario->estado ?? null, // Permitir null si no está definido
            'nota_final' => $formulario->nota_final ?? 0, // Valor predeterminado si no se proporciona
            'teacher_id' => $formulario->teacher_id,
            'grupo_id' => $formulario->grupo_id,
        ]);

        Log::info('Matrícula creada:', $matricula->toArray());

        // Eliminar el formulario
        $formulario->delete();

        Log::info('Formulario eliminado:', ['id' => $id]);

        DB::commit();

        return redirect()->route('formularios.index')->with('success', 'Estudiante y matrícula registrados correctamente. El formulario ha sido eliminado.');
    } catch (\Exception $e) {
        DB::rollBack();

        // Registro del error para depuración
        Log::error('Error al inscribir estudiante: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
        ]);

        return redirect()->route('formularios.index')->with('error', 'Ocurrió un error al procesar la inscripción: ' . $e->getMessage());
    }
}


    

    public function destroy($id)
    {
        $formulario = FormularioInscripcion::findOrFail($id);
        $formulario->delete();

        return redirect()->route('formularios.index');
    }
}





    
    
















