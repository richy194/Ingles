<?php



namespace App\Http\Controllers;

use App\Models\PeriodoAcademico;
use Illuminate\Http\Request;

class PeriodoAcademicoController extends Controller
{
    // Mostrar todos los periodos académicos
    public function index()
    {
        $periodos = PeriodoAcademico::all();
        return view('periodos.index', compact('periodos'));
    }

    // Mostrar el formulario para crear un nuevo periodo académico
    public function create()
    {
        return view('periodos.create');
    }

    // Guardar un nuevo periodo académico
    public function store(Request $request)
    {
        $request->validate([
            'año' => 'required|integer|digits:4',
            'nombre' => 'required|string|max:255',
            'periodo' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:500',
        ]);

        PeriodoAcademico::create($request->all());

        return redirect()->route('periodos.index')->with('success', 'Periodo académico creado exitosamente.');
    }

    // Mostrar un periodo académico específico
    public function show(PeriodoAcademico $periodo)
    {
        return view('periodos.show', compact('periodo'));
    }

    // Mostrar el formulario para editar un periodo académico
    public function edit(PeriodoAcademico $periodo)
    {
        return view('periodos.edit', compact('periodo'));
    }

    // Actualizar un periodo académico existente
    public function update(Request $request, PeriodoAcademico $periodo)
    {
        $request->validate([
            'año' => 'required|integer|digits:4',
            'nombre' => 'required|string|max:255',
            'periodo' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $periodo->update($request->all());

        return redirect()->route('periodos.index')->with('success', 'Periodo académico actualizado exitosamente.');
    }

    // Eliminar un periodo académico
    public function destroy(PeriodoAcademico $periodo)
    {
        $periodo->delete();

        return redirect()->route('periodos.index')->with('success', 'Periodo académico eliminado exitosamente.');
    }
}
