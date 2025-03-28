<?php

namespace App\Imports;

use App\Models\Theacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TheachersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Crea un nuevo registro de Theacher a partir de los datos de una fila de Excel.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Theacher([
            'nombre'    => $row['nombre'],
            'email'     => $row['email'],
            'documento' => $row['documento'], // corregido: usás minúsculas en el Excel
            'telefono'  => $row['telefono'] ?? null,
            'direccion' => $row['direccion'] ?? null,
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
            'nombre'    => 'required|string|max:255',
            'email'     => 'required|email|unique:theachers,email',
            'documento' => 'required|string|max:255|unique:theachers,documento',
            'telefono'  => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ];
    }
}

