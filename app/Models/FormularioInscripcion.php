<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\belongsTo ;

class FormularioInscripcion extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'documento',
        'direccion',
        'telefono',
        'fecha_matricula',
        'estado',
        'nota_final',
        'teacher_id',
        'grupo_id',
        
        
    ];
   

    public function teacher()
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }

    // Relación con Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'grupo_id');
    }
}
