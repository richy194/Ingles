<?php

namespace App\Exports;

use App\Models\Matricula;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatriculasExport implements FromCollection, WithHeadings
{
    /**
     * Retorna la colección de datos para el archivo Excel.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Matricula::select(
            "id", 
            "fecha_matricula", 
            "estado", 
            "nota_final", 
            "teacher_id", 
            "grupo_id", 
            "student_id"
        )->get();
    }

    /**
     * Define los encabezados de las columnas en el archivo Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            "Fecha_matricula", 
            "Estado", 
            "nota_final", 
            "teacher_id", 
            "grupo_id", 
            "student_id"
        ];
    }
}

