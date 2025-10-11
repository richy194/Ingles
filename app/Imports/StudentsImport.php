<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    /**
     * Contador de registros insertados correctamente.
     */
    private int $insertedCount = 0;

    /**
     * Crea un nuevo registro de Student a partir de los datos de una fila del Excel.
     */
    public function model(array $row)
    {
        $nombre = trim($row['nombre'] ?? '');
        $email  = trim($row['email'] ?? '');

        // Verifica que no exista otro estudiante con el mismo correo
        if (Student::where('email', $email)->exists()) {
            return null; // No insertar duplicado
        }

        // Incrementa el contador si se inserta
        $this->insertedCount++;

        return new Student([
            'nombre'    => $nombre,
            'email'     => $email,
            'documento' => null,
            'direccion' => null,
            'telefono'  => null,
        ]);
    }

    /**
     * Reglas de validación del archivo Excel.
     */
    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'distinct',           // evita emails repetidos dentro del mismo archivo
                'unique:students,email', // evita emails repetidos ya existentes en BD
            ],
        ];
    }

    /**
     * Mensajes personalizados de validación.
     */
    public function customValidationMessages()
    {
        return [
            'nombre.required'  => 'El campo nombre es obligatorio.',
            'nombre.string'    => 'El nombre debe ser una cadena válida.',
            'email.required'   => 'El campo email es obligatorio.',
            'email.email'      => 'El email no tiene un formato válido.',
            'email.unique'     => 'El email ":input" ya existe en la base de datos.',
            'email.distinct'   => 'El email ":input" está repetido dentro del archivo Excel.',
        ];
    }

    /**
     * Devuelve la cantidad de registros insertados exitosamente.
     */
    public function getInsertedCount(): int
    {
        return $this->insertedCount;
    }
}

