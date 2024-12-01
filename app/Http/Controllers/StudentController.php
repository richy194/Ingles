<?

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    // Muestra todos los estudiantes con la posibilidad de filtrarlos por nombre y documento
    public function index(Request $request)
    {
        $query = $request->get('query');
        $estudiantes = Student::when($query, function($queryBuilder) use ($query) {
            return $queryBuilder->where('nombre', 'like', '%' . $query . '%')
                                ->orWhere('documento', 'like', '%' . $query . '%');
        })->get();
    
        return view('estudiantes.index', compact('estudiantes'));
    }

    // Muestra un estudiante específico
    public function show($id)
    {
        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        return view('estudiantes.show', compact('estudiante')); // Muestra la vista para ver al estudiante
    }

    // Crea un nuevo estudiante (solo para admins)
    public function create()
    {
        return view('estudiantes.create'); // Muestra la vista para crear un nuevo estudiante
    }

    // Guarda un nuevo estudiante
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        Student::create($validated); // Crea el estudiante
        return redirect()->route('estudiantes.index'); // Redirige al índice de estudiantes
    }

    // Edita un estudiante
    public function edit($id)
    {
        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        return view('estudiantes.edit', compact('estudiante')); // Muestra la vista para editar al estudiante
    }

    // Actualiza un estudiante
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'documento' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        $estudiante->update($validated); // Actualiza los campos
        return redirect()->route('estudiantes.index'); // Redirige al índice de estudiantes
    }

    // Elimina un estudiante
    public function destroy($id)
    {
        $estudiante = Student::findOrFail($id); // Encuentra al estudiante por ID
        $estudiante->delete(); // Elimina al estudiante
        return redirect()->route('estudiantes.index'); // Redirige al índice de estudiantes
    }

    public function export()
    {
        // Utilizamos el método download de Excel para exportar los datos.
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function import(Request $request)
    {
        // Validación de archivo
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // Importar los datos del archivo Excel
        Excel::import(new StudentsImport, $request->file('file'));

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Estudiantes importados correctamente.');
    }

    public function destroyMultiple(Request $request)
{
    // Validar que se han enviado IDs
    $request->validate([
        'ids' => 'required|array|min:1',
        'ids.*' => 'exists:students,id',
    ]);

    // Eliminar los estudiantes seleccionados
    Student::whereIn('id', $request->ids)->delete();

    return redirect()->route('estudiantes.index')->with('success', 'Estudiantes eliminados correctamente.');
}
}



