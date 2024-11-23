<?php

namespace App\Exports;

use App\Models\Matricula;
use Maatwebsite\Excel\Concerns\FromCollection;

class MatriculasExport implements FromCollection
{
    public function collection()
    {
        // Obtén todas las matrículas
        return Matricula::all();
    }
}
