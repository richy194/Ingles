<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany ;
use Illuminate\Database\Eloquent\Relations\belongsTo ;

class Theacher extends Model
{

    protected $fillable = ['nombre','email', 'Documento', 'telefono',  'direccion'];
    use HasFactory, SoftDeletes;

   

    public function cursos():hasMany
    {
        return $this->hasMany(Curso::class, 'teacher_id');
    }

    public function matriculas():hasMany
    {
        return $this->hasMany(Matricula::class, 'teacher_id');
    }

    public function formularios()
    {
        return $this->hasMany(FormularioInscripcion::class);
    }
}
