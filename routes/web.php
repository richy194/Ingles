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
use App\Imports\MatriculaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\TheacherController;
use App\Http\Controllers\StudentController;

// Mostrar el formulario de inscripción
Route::get('/inscripcion', [FormularioInscripcionController::class, 'create'])->name('inscripcion.create');

// Procesar el formulario de inscripción
Route::post('/inscripcion', [FormularioInscripcionController::class, 'store'])->name('matricula.store');

// Ruta para login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Ruta para registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Ruta del dashboard con middleware de autenticación
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Rutas de recursos (CRUD)
    Route::resource('cursos', CursoController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('matriculas', MatriculaController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('periodos', PeriodoAcademicoController::class);
   
   
   
   
});

 Route::get('matriculas-export', [MatriculaController::class, 'export'])->name('matriculas.export');

 Route::post('matriculas-import', [MatriculaController::class, 'import'])->name('matriculas.import');
 Route::get('estudiantes-export', [StudentController::class, 'export'])->name('estudiantes.export');
 Route::post('estudiantes-import', [StudentController::class, 'import'])->name('estudiantes.import');




Route::resource('profesores', TheacherController::class);
Route::resource('estudiantes', StudentController::class);
 Route::resource('formularios', FormularioController::class);
 


Route::post('/formularios/inscribir/{id}', [FormularioController::class, 'inscribir'])->name('formularios.inscribir');



Route::get('/', function () {
    return redirect('login');
});

Route::get('/student-data/{id}', [MatriculaController::class, 'getStudentDataForMatricula']);
Route::delete('estudiantes-destroy-multiple', [StudentController::class, 'destroyMultiple'])->name('estudiantes.destroyMultiple');
Route::delete('matriculas-destroy-multiple', [MatriculaController::class, 'destroyMultiple'])->name('matriculas.destroyMultiple');
