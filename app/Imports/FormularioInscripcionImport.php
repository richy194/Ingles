<?php

namespace App\Imports;

use App\Models\FormularioInscripcion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FormularioInscripcionImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Crea un nuevo registro de FormularioInscripcion a partir de los datos de una fila de Excel.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new FormularioInscripcion([
            'name'             => $row['name'],             // Nombre del estudiante
            'email'            => $row['email'],            // Correo del estudiante
            'documento'        => $row['documento'],        // Documento único
            'direccion'        => $row['direccion'] ?? null, // Dirección opcional
            'telefono'         => $row['telefono'] ?? null, // Teléfono opcional
            'fecha_matricula'  => $row['fecha_matricula']?? null,  // Fecha de matrícula
            'estado'           => $row['estado'] ?? null,   // Estado opcional
            'nota_final'       => $row['nota_final'] ?? null,  // Nota predeterminada
            'teacher_id'       => $row['teacher_id']?? null,     // ID del profesor
            'grupo_id'         => $row['grupo_id']?? null,         // ID del grupo
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
            'name'             => 'required|string|max:255',
            'email' => 'required|email',
            'documento' => 'required|string|max:255',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:255',
            'fecha_matricula'  => 'nullable|date',
            'estado'           => 'nullable|string|max:255',
            'nota_final'       => 'nullable|numeric|min:0|max:100',
            'teacher_id'       => 'nullable|exists:theachers,id',
            'grupo_id'         => 'nullable|exists:groups,id',
        ];
    }
}
