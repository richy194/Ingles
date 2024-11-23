<?php
namespace App\Imports;

use App\Models\Matricula;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MatriculasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Matricula([
            'name' => $row['name'],
            'email' => $row['email'],
            'Documento' => $row['documento'],
            'direccion' => $row['direccion'],
            'telefono' => $row['telefono'],
            'fecha_matricula' => $row['fecha_matricula'],
            'estado' => $row['estado'],
            'nota_final' => $row['nota_final'],
            'curso_id' => $row['curso_id'],
            'teacher_id' => $row['teacher_id'],
        ]);
    }
}
