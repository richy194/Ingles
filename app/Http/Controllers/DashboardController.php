<?
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
        // Obtener datos dinámicos de la base de datos
        $cursos = Curso::with('teacher')->latest()->take(5)->get();
        $grupos = Group::with('curso')->latest()->take(5)->get();
        $matriculas = Matricula::latest()->take(5)->get();
        $usuarios = User::with('roles')->latest()->take(5)->get();
        $periodos = PeriodoAcademico::latest()->take(5)->get();
        $formularios = FormularioInscripcion::latest()->take(5)->get();
        $profesores = Theacher::latest()->take(5)->get(); // NUEVO
        $estudiantes = Student::latest()->take(5)->get(); // NUEVO

        // Pasar datos a la vista
        return view('dash', compact('cursos', 'grupos', 'matriculas', 'usuarios', 'periodos', 'formularios', 'profesores', 'estudiantes'));
    }
}

