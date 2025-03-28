<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    // Mostrar el formulario de registro
    public function create()
    {
        return view('auth.register'); // Asegúrate de tener la vista de registro
    }

    // Manejar el registro
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Agrega 'confirmed' para verificar la confirmación de contraseña
            'role_id' => ['required', 'exists:roles,id'], // Asegúrate de que el rol existe
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // Asigna el rol
        ]);

        // Autenticar al usuario después de registrarse
        auth()->login($user);

        // Redirigir al panel de administración de Filament
        return redirect()->route('filament.pages.dashboard'); // Cambia esto si tienes una ruta diferente
    }
}
