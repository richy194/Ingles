<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\FormularioInscripcionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Mostrar el formulario de inscripción
Route::get('/inscripcion', [FormularioInscripcionController::class, 'create'])->name('inscripcion.create');

// Procesar el formulario de inscripción
Route::post('/inscripcion', [FormularioInscripcionController::class, 'store'])->name('inscripcion.store');

// Ruta para login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\AuthenticatedSessionController@store')->name('login.store');

Route::post('/logout', 'App\Http\Controllers\Auth\AuthenticatedSessionController@destroy')->name('logout');
// Ruta para registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
