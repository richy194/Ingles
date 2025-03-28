<?php

namespace App\Imports;

use App\Models\Matricula;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MatriculasImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Crea un nuevo registro de Matricula a partir de los datos de una fila de Excel.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Matricula([
            'fecha_matricula' => $row['fecha_matricula'],  // Asegúrate de que coincida con el encabezado del Excel
            'estado'          => $row['estado'],          // Debe estar en el Excel
            'nota_final'      => $row['nota_final'],      // Campo opcional o validado
            'teacher_id'      => $row['teacher_id'],      // Referencia al profesor
            'grupo_id'        => $row['grupo_id'],        // Referencia al grupo
            'student_id'      => $row['student_id'],      // Referencia al estudiante
        ]);
    }

    /**
     * Define las reglas de validación para cada fila del archivo Excel.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'fecha_matricula' => 'required|date', // Debe ser una fecha válida
            'estado'          => 'nullable|string|max:255', // Validación del estado
            'nota_final'      => 'nullable|numeric|min:0|max:255', // Nota entre 0 y 100
            'teacher_id'      => 'required|exists:theachers,id', // Verifica que el ID de profesor exista
            'grupo_id'        => 'required|exists:cursos,id',    // Verifica que el grupo exista
            'student_id'      => 'required|exists:students,id',  // Verifica que el estudiante exista
        ];
    }
}
