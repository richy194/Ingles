<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semestre extends Model
{

    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin'];
    use HasFactory, SoftDeletes;


    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    
    public function theachers()
    {
        return $this->hasMany(Theacher::class); // Si consideras que un semestre puede tener múltiples docentes
    }
}
