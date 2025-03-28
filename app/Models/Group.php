<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo ;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
       'horario','nombre' ,'curso_id', 'periodo_id', 'cantidad', 'teacher_id'
    ];
    
    protected $casts = [
        'horario' => 'array', // Convierte el campo JSON en un array automáticamente
    ];
    public function curso():belongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
    
    public function pofe():belongsTo
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }

    public function periodo_academicos()
    {
        return $this->belongsTo(PeriodoAcademico::class, 'periodo_id');
    }
   
    public function formularios()
    {
        return $this->hasMany(FormularioInscripcion::class);
    }
}
