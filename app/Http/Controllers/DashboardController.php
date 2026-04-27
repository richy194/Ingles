<?php
namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Group;
use App\Models\Matricula;
use App\Models\User;
use App\Models\PeriodoAcademico;
use App\Models\FormularioInscripcion;
use App\Models\Theacher;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener ultimos registros para paneles del dashboard
        $cursos = Curso::with('teacher')->latest()->take(5)->get();
        $grupos = Group::with('curso')->latest()->take(5)->get();
        $matriculas = Matricula::latest()->take(5)->get();
        $usuarios = User::with('roles')->latest()->take(5)->get();
        $periodos = PeriodoAcademico::latest()->take(5)->get();
        $formularios = FormularioInscripcion::latest()->take(5)->get();
        $profesores = Theacher::latest()->take(5)->get();
        $estudiantes = Student::latest()->take(5)->get();

        // Metricas generales para KPIs
        $stats = [
            'cursos' => Curso::count(),
            'grupos' => Group::count(),
            'matriculas' => Matricula::count(),
            'usuarios' => User::count(),
            'periodos' => PeriodoAcademico::count(),
            'formularios' => FormularioInscripcion::count(),
            'profesores' => Theacher::count(),
            'estudiantes' => Student::count(),
        ];

        return view('dash', compact(
            'cursos',
            'grupos',
            'matriculas',
            'usuarios',
            'periodos',
            'formularios',
            'profesores',
            'estudiantes',
            'stats'
        ));
    }
}

