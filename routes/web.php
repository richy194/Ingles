<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormularioInscripcionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PeriodoAcademicoController;
use App\Http\Controllers\FormularioController;
use App\Exports\MatriculaExport;
use App\Imports\MatriculaImport ;
use Maatwebsite\Excel\Facades\Excel;


// Mostrar el formulario de inscripción
Route::get('/inscripcion', [FormularioInscripcionController::class, 'create'])->name('inscripcion.create');

// Procesar el formulario de inscripción
Route::post('/inscripcion', [FormularioInscripcionController::class, 'store'])->name('matricula.store');

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Ruta para cursos
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
    
    // Ruta para grupos
    Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');
    
    // Ruta para matrículas
    Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');
    // No es necesario definir una ruta para almacenar matrículas, ya está en Route::resource
    
    // Ruta para usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

    Route::get('/periodos', [PeriodoAcademicoController::class,'index'])->name('periodos.index');
    Route::get('/formularios',[ FormularioController::class,'index'])->name('formularios.index');
});

Route::resource('cursos', CursoController::class)->middleware('auth');
Route::resource('grupos', GrupoController::class)->middleware('auth');
Route::resource('matriculas', MatriculaController::class)->middleware('auth');
Route::resource('periodos', PeriodoAcademicoController::class)->middleware('auth');
Route::resource('formularios', FormularioController::class)->middleware('auth');

Route::get('/', function () {
    return redirect('login');
});

Route::post('/formularios/inscribir/{formulario}', [FormularioController::class, 'inscribir'])->name('formularios.inscribir');

Route::get('matriculas/export', [MatriculaController::class, 'export'])->name('matriculas.export');
Route::post('matriculas/import', [MatriculaController::class, 'import'])->name('matriculas.import');

Route::get('/export', function () {
    return Excel::download(new MatriculaExport, 'users.xlsx');
});

Route::post('/import', function () {
    Excel::import(new MatriculaImport, request()->file('file'));
    return redirect('/')->with('success', 'Archivo importado exitosamente');
}); 
