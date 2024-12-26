<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsTo ;
use Illuminate\Database\Eloquent\Relations\hasMany ;
class Curso extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nombre', 'codigo', 'descripcion','nivel_curso', 'fecha_inicio', 'fecha_fin','requisito','modalidad', 'periodo_id', 'teacher_id'];

    public function periodo()
    {
        return $this->belongsTo(PeriodoAcademico::class,'periodo_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }

   
    

    public function grupos()
    {
        return $this->hasMany(Group::class, 'curso_id');
    }

     // Relación con Matricula
     public function matriculas()
     {
         return $this->hasMany(Matricula::class, 'grupo_id'); // Cambia 'grupo_id' por el nombre correcto de la columna
     }
 
     // Relación con FormularioInscripcion
     public function formularios()
     {
         return $this->hasMany(FormularioInscripcion::class, 'grupo_id'); // Cambia 'grupo_id' por el nombre correcto de la columna
        }
}
