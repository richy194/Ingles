<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Crea un nuevo registro de Student a partir de los datos de una fila de Excel.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'nombre'   => $row['nombre'],     // Asegúrate de que coincida con el encabezado del Excel
            'email'    => $row['email'],      // Debe estar en el Excel
            'documento'=> $row['documento'],  // Campo opcional o validado
            'direccion'=> $row['direccion'],  // Dirección
            'telefono' => $row['telefono'],   // Teléfono
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
            'nombre'    => 'required|string|max:255',    // Nombre del estudiante
            'email'     =>  'required|email',   // Correo electrónico debe ser único
            'documento' => 'required|string|max:255',    // Documento de identificación
            'direccion' => 'nullable|string|max:255',    // Dirección opcional
            'telefono'  => 'nullable|string|max:255',     // Teléfono opcional
        ];
    }
}
