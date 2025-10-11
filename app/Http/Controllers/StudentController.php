<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class StudentController extends Controller
{
    /**
     * Muestra todos los estudiantes con opción de búsqueda.
     */
    public function index(Request $request)
    {
        $query = $request->get('query');

        $estudiantes = Student::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nombre', 'like', '%' . $query . '%')
                                ->orWhere('documento', 'like', '%' . $query . '%');
        })->get();

        return view('estudiantes.index', compact('estudiantes'));
    }

    /**
     * Muestra un estudiante específico.
     */
    public function show($id)
    {
        $estudiante = Student::findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Muestra el formulario para crear un nuevo estudiante.
     */
    public function create()
    {
        return view('estudiantes.create');
    }

    /**
     * Guarda un nuevo estudiante manualmente.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'documento' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un estudiante.
     */
    public function edit($id)
    {
        $estudiante = Student::find($id);

        if (!$estudiante) {
            return redirect()->route('estudiantes.index')->with('error', 'Estudiante no encontrado.');
        }

        return view('estudiantes.edit', compact('estudiante'));
    }

    /**
     * Actualiza un estudiante.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'documento' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
        ]);

        $estudiante = Student::findOrFail($id);
        $estudiante->update($validated);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    /**
     * Elimina un estudiante.
     */
    public function destroy($id)
    {
        $estudiante = Student::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
    }

    /**
     * Exporta todos los estudiantes a Excel.
     */
    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    /**
     * Importa estudiantes desde un archivo Excel o CSV.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            // Crear instancia del import
            $import = new StudentsImport;
            Excel::import($import, $request->file('file'));

            $insertedCount = $import->getInsertedCount();

            if ($insertedCount === 0) {
                return redirect()->back()->with('warning', 'No se importó ningún estudiante (todos eran duplicados o inválidos).');
            }

            return redirect()->back()->with('success', "Se importaron {$insertedCount} estudiantes correctamente.");

        } catch (ValidationException $e) {
            // Captura errores de validación del Excel
            $failures = $e->failures();
            $errores = [];

            foreach ($failures as $failure) {
                $errores[] = "Fila {$failure->row()}: " . implode(', ', $failure->errors());
            }

            return redirect()->back()->with('error', 'Error al importar: ' . implode(' | ', $errores));
        } catch (\Exception $e) {
            // Captura cualquier otro error
            return redirect()->back()->with('error', 'Hubo un problema al importar el archivo: ' . $e->getMessage());
        }
    }

    /**
     * Elimina múltiples estudiantes seleccionados.
     */
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:students,id',
        ]);

        Student::whereIn('id', $request->ids)->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiantes eliminados correctamente.');
    }
}
