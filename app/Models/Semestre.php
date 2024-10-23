<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany ;
class Semestre extends Model
{

    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_final'];
    use HasFactory, SoftDeletes;


    public function cursos():hasMany
    {
        return $this->hasMany(Curso::class);
    }

    
    public function theachers():hasMany
    {
        return $this->hasMany(Theacher::class); // Si consideras que un semestre puede tener múltiples docentes
    }
}
