<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('dashboard', compact('usuarios')); // Pasar los usuarios a la vista
    }
}
