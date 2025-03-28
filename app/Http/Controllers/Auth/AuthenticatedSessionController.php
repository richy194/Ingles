<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function create()
    {
        return view('auth.login'); // Asegúrate de tener la vista de inicio de sesión
    }

    // Manejar el inicio de sesión
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerar la sesión
            $request->session()->regenerate();

            // Redirigir al panel de administración de Filament
            return redirect()->route('dashboard'); // Cambia esto si tienes una ruta diferente
        }

        // Si las credenciales son incorrectas
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }

    // Manejar el cierre de sesión
    public function destroy(Request $request)
    {
        Auth::logout();

        // Redirigir al inicio de sesión
        return redirect()->route('login');
    }
}
