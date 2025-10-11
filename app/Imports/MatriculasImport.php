<?php

namespace App\Imports;

use App\Models\Matricula;
use App\Models\Curso;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class MatriculasImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected $registrosImportados = [];
    protected int $insertadas = 0;
    protected int $ignoradas = 0;
    protected array $mensajes = [];

    public function model(array $row)
    {
        $email = strtolower(trim($row['email'] ?? ''));
        $grupoId = $row['grupo_id'] ?? null;
        $nota = $row['nota_final'] ?? null;

        if (!$email || !$grupoId) {
            $this->ignoradas++;
            $this->mensajes[] = "⚠️ Fila ignorada: faltan datos obligatorios (email o grupo_id).";
            return null;
        }

        $estudiante = Student::whereRaw('LOWER(TRIM(email)) = ?', [$email])->first();
        $curso = Curso::find($grupoId);

        if (!$curso || !$estudiante) {
            $this->ignoradas++;
            $this->mensajes[] = "⚠️ Registro ignorado: estudiante o curso no encontrado ({$email}, grupo {$grupoId}).";
            return null;
        }

        $duplicado = Matricula::where('student_id', $estudiante->id)
            ->where('grupo_id', $curso->id)
            ->exists();

        if ($duplicado) {
            $this->ignoradas++;
            $this->mensajes[] = "⚠️ Duplicado ignorado: {$email} ya está matriculado en {$curso->nombre}.";
            return null;
        }

        $matricula = new Matricula([
            'student_id'      => $estudiante->id,
            'grupo_id'        => $curso->id,
            'nota_final'      => is_numeric($nota) ? $nota : null,
            'fecha_matricula' => now(),
            'estado'          => 'En progreso',
            'teacher_id'      => $curso->teacher_id ?? null,
        ]);

        $this->insertadas++;
        $this->mensajes[] = "✅ {$email} matriculado en {$curso->nombre}.";
        $this->registrosImportados[] = $matricula;

        return $matricula;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:students,email',
            'grupo_id' => 'required|exists:cursos,id',
            'nota_final' => 'nullable|numeric|min:0|max:100',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'email.required' => 'El correo del estudiante es obligatorio.',
            'email.email' => 'El formato del correo no es válido.',
            'email.exists' => 'El estudiante con ese correo no existe en el sistema.',
            'grupo_id.required' => 'El grupo (curso) es obligatorio.',
            'grupo_id.exists' => 'El grupo indicado no existe.',
            'nota_final.numeric' => 'La nota final debe ser un número.',
        ];
    }

    public function getMatriculas()
    {
        return $this->registrosImportados;
    }

    public function getResumen(): array
    {
        return [
            'insertadas' => $this->insertadas,
            'ignoradas' => $this->ignoradas,
            'mensajes' => $this->mensajes,
        ];
    }
}

