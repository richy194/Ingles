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
use Illuminate\Support\Facades\Log;

class MatriculaController extends Controller
{
    /** 🧾 LISTAR MATRÍCULAS */
    public function index(Request $request)
    {
        $query = $request->get('query');

        $matriculas = Matricula::with(['student', 'curso', 'teacher'])
            ->when($query, function ($q) use ($query) {
                return $q->whereHas('student', function ($sub) use ($query) {
                    $sub->where('nombre', 'like', "%$query%")
                        ->orWhere('documento', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%");
                });
            })
            ->paginate(20)
            ->withQueryString();

        return view('matriculas.index', compact('matriculas'));
    }

    /** 📄 MOSTRAR DETALLE DE MATRÍCULA */
    public function show($id)
    {
        $matricula = Matricula::with(['curso', 'teacher'])->findOrFail($id);
        return view('matriculas.show', compact('matricula'));
    }

    /** 🧑‍🏫 FORMULARIO DE CREACIÓN */
    public function create()
    {
        $cursos = Curso::all();
        $teachers = Theacher::all();
        $students = Student::all();

        return view('matriculas.create', compact('cursos', 'teachers', 'students'));
    }

    /** 💾 GUARDAR NUEVA MATRÍCULA */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'grupo_id' => 'required|exists:cursos,id',
            'teacher_id' => 'nullable|exists:theachers,id',
            'fecha_matricula' => 'nullable|date',
            'estado' => 'nullable|string|max:255',
            'nota_final' => 'nullable|numeric|min:0|max:100',
        ]);

        return $this->matricularEstudiante(
            $validated['student_id'],
            $validated['grupo_id']
        );
    }

    /** ✏️ EDITAR MATRÍCULA */
    public function edit($id)
    {
        $matricula = Matricula::findOrFail($id);
        $cursos = Curso::all(); 
        $teachers = Theacher::all();
        $students = Student::all();

        return view('matriculas.edit', compact('matricula', 'cursos', 'teachers', 'students'));
    }

    /** 🔄 ACTUALIZAR MATRÍCULA */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'grupo_id' => 'required|exists:cursos,id',
            'teacher_id' => 'nullable|exists:theachers,id',
            'fecha_matricula' => 'nullable|date',
            'estado' => 'nullable|string|max:255',
            'nota_final' => 'nullable|numeric|min:0|max:100',
        ]);

        $matricula = Matricula::findOrFail($id);

        return $this->matricularEstudiante(
            $validated['student_id'],
            $validated['grupo_id'],
            $matricula
        );
    }

    /** ❌ ELIMINAR MATRÍCULA */
    public function destroy($id)
    {
        Matricula::findOrFail($id)->delete();
        return redirect()->route('matriculas.index')->with('success', 'Matrícula eliminada correctamente.');
    }

    /** 📤 EXPORTAR A EXCEL */
    public function export()
    {
        return Excel::download(new MatriculasExport, 'matriculas.xlsx');
    }

    /** 📥 IMPORTAR DESDE EXCEL */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        try {
            $import = new MatriculasImport;
            Excel::import($import, $request->file('file'));

            // ⚠️ Si hubo fallas de validación
            if ($import->failures()->isNotEmpty()) {
                return back()->with([
                    'warning' => 'Algunos registros fallaron en la validación del archivo.',
                    'failures' => $import->failures(),
                ]);
            }

            // 📊 Obtener resumen del import
            $resumen = $import->getResumen();
            $matriculas = $import->getMatriculas();

            // 💾 Guardar las matrículas nuevas
            foreach ($matriculas as $matricula) {
                try {
                    $existe = Matricula::where('student_id', $matricula->student_id)
                        ->where('grupo_id', $matricula->grupo_id)
                        ->exists();

                    if (!$existe) {
                        $matricula->save();
                    }
                } catch (\Throwable $e) {
                    Log::warning('Error guardando matrícula durante importación', [
                        'error' => $e->getMessage(),
                        'matricula' => $matricula
                    ]);
                }
            }

            // 📋 Preparar mensaje final
            $mensajeFinal = "✅ Se importaron {$resumen['insertadas']} matrículas correctamente.";
            if ($resumen['ignoradas'] > 0) {
                $mensajeFinal .= " ⚠️ {$resumen['ignoradas']} registros fueron ignorados.";
            }

            return back()->with([
                'success' => $mensajeFinal,
                'detalles' => $resumen['mensajes'],
            ]);

        } catch (\Throwable $e) {
            Log::error('Error al importar matrículas: '.$e->getMessage());
            return back()->with('error', '❌ Error al procesar el archivo. Verifique el formato o los encabezados.');
        }
    }

    /** 🔍 OBTENER DATOS DE UN ESTUDIANTE */
    public function getStudentDataForMatricula($id)
    {
        $student = Student::findOrFail($id);

        return response()->json([
            'nombre' => $student->nombre,
            'email' => $student->email,
            'documento' => $student->documento,
            'direccion' => $student->direccion,
            'telefono' => $student->telefono
        ]);
    }

    /** 🗑️ ELIMINAR VARIAS MATRÍCULAS */
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:matriculas,id',
        ]);

        Matricula::whereIn('id', $request->ids)->delete();

        return redirect()->route('matriculas.index')->with('success', 'Matrículas eliminadas correctamente.');
    }

    /** 🎓 VALIDAR Y CREAR/ACTUALIZAR MATRÍCULA */
    public function matricularEstudiante($estudianteId, $cursoId, $matricula = null)
    {
        $curso = Curso::findOrFail($cursoId);
        $estudiante = Student::findOrFail($estudianteId);

        // 🔹 Verificar curso requisito
        if ($curso->requisito) {
            $cursoRequisito = Curso::find($curso->requisito);

            if (!$cursoRequisito) {
                return redirect()->back()->with('error', 'El curso requerido no existe.');
            }

            $matriculaRequisito = Matricula::where('student_id', $estudianteId)
                ->where('grupo_id', $cursoRequisito->id)
                ->where('estado', 'Aprobado')
                ->first();

            if (!$matriculaRequisito) {
                return redirect()->back()->with('error', "El estudiante {$estudiante->nombre} no cumple el requisito {$cursoRequisito->nombre}.");
            }
        }

        // 🔹 Evitar duplicados
        $matriculaExistente = Matricula::where('student_id', $estudianteId)
            ->where('grupo_id', $cursoId)
            ->first();

        if ($matriculaExistente && (!$matricula || $matriculaExistente->id !== $matricula->id)) {
            return redirect()->back()->with('error', "El estudiante {$estudiante->nombre} ya está matriculado en {$curso->nombre}.");
        }

        // 🔹 Datos de la matrícula
        $data = [
            'student_id' => $estudianteId,
            'grupo_id' => $cursoId,
            'teacher_id' => $curso->teacher_id,
            'fecha_matricula' => now(),
            'estado' => request()->input('estado', $matricula ? $matricula->estado : 'En progreso'),
            'nota_final' => request()->input('nota_final', $matricula ? $matricula->nota_final : null),
        ];

        // 🔹 Crear o actualizar
        if ($matricula) {
            $matricula->update($data);
        } else {
            Matricula::create($data);
        }

        return redirect()->route('matriculas.index')
            ->with('success', "✅ El estudiante {$estudiante->nombre} se ha matriculado correctamente en {$curso->nombre}.");
    }
}
