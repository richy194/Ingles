<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nombre', 'codigo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'semestre_id', 'teacher_id'];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'grupo_id');
    }
}
