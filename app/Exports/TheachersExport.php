<?php

namespace App\Exports;

use App\Models\Theacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TheachersExport implements FromCollection, WithHeadings
{
    /**
     * Retorna la colección de datos para el archivo Excel.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Seleccionamos los campos del modelo Theacher que queremos exportar
        return Theacher::select('nombre', 'email', 'documento', 'direccion', 'telefono')->get();
    }

    /**
     * Define los encabezados de las columnas en el archivo Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'nombre',
            'email',
            'documento',
            'direccion',
            'telefono'
        ];
    }
}

