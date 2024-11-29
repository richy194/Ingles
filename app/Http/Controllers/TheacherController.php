<?php

namespace App\Http\Controllers;

use App\Models\Theacher;
use Illuminate\Http\Request;

class TheacherController extends Controller
{
    // Muestra todos los profesores
    public function index()
    {
        $profesores = Theacher::all(); // Obtén todos los profesores
        return view('profesores.index', compact('profesores')); // Pasa los profesores a la vista
    }

    // Muestra un profesor específico
    public function show($id)
    {
        $profesor = Theacher::findOrFail($id); // Encuentra al profesor por ID
        return view('profesores.show', compact('profesor')); // Muestra la vista para ver al profesor
    }

    // Crea un nuevo profesor (solo para admins)
    public function create()
    {
        return view('profesores.create'); // Muestra la vista para crear un nuevo profesor
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

        Theacher::create($validated); // Crea el profesor
        return redirect()->route('profesores.index'); // Redirige al índice de profesores
    }

    // Edita un profesor
    public function edit($id)
    {
        $profesor = Theacher::findOrFail($id); // Encuentra al profesor por ID
        return view('profesores.edit', compact('profesor')); // Muestra la vista para editar al profesor
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

        $profesor = Theacher::findOrFail($id); // Encuentra al profesor por ID
        $profesor->update($validated); // Actualiza los campos
        return redirect()->route('profesores.index'); // Redirige al índice de profesores
    }

    // Elimina un profesor
    public function destroy($id)
    {
        $profesor = Theacher::findOrFail($id); // Encuentra al profesor por ID
        $profesor->delete(); // Elimina al profesor
        return redirect()->route('profesores.index'); // Redirige al índice de profesores
    }
}
