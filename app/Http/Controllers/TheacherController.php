<?php

namespace App\Http\Controllers;

use App\Models\Theacher;
use Illuminate\Http\Request;
use App\Imports\TheacherImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TheacherExport;



class TheacherController extends Controller
{
    // Muestra todos los profesores
    public function index()
    {
        $profesores = Theacher::all(); 
        return view('profesores.index', compact('profesores')); 
    }

    // Muestra un profesor específico
    public function show($id)
    {
        $profesor = Theacher::findOrFail($id); 
        return view('profesores.show', compact('profesor')); 
    }

    // Muestra el formulario para crear
    public function create()
    {
        return view('profesores.create'); 
    }

    // Guarda un nuevo profesor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'Documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        Theacher::create($validated); 
        return redirect()->route('profesores.index'); 
    }

    // Edita un profesor
    public function edit($id)
    {
        $profesor = Theacher::findOrFail($id); 
        return view('profesores.edit', compact('profesor')); 
    }

    // Actualiza un profesor
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'Documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        $profesor = Theacher::findOrFail($id); 
        $profesor->update($validated); 
        return redirect()->route('profesores.index'); 
    }

    // Elimina un profesor
    public function destroy($id)
    {
        $profesor = Theacher::findOrFail($id); 
        $profesor->delete(); 
        return redirect()->route('profesores.index'); 
    }

    // 🆕 Método para importar profesores desde Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new TheacherImport, $request->file('file'));

        return redirect()->route('profesores.index')->with('success', 'Profesores importados exitosamente.');
    }

    // 🆕 Método para exportar profesores a Excel
public function export()
{
    return Excel::download(new TheacherExport, 'profesores.xlsx');
}

}
