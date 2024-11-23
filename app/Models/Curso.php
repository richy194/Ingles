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
    protected $fillable = ['nombre', 'codigo', 'descripcion','nivel_curso', 'fecha_inicio', 'fecha_fin','requisito','modalidad', 'semestre_id', 'teacher_id'];

    public function semestre():belongsTo
    {
        return $this->belongsTo(Semestre::class);
    }

    public function teacher():belongsTo
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }

    public function matriculas():hasMany
    {
        return $this->hasMany(Matricula::class, 'grupo_id');
    }

    public function groups():hasMany
    {
// Suggested code may be subject to a license. Learn more: ~LicenseLog:876070114.
        return $this->hasMany(group::class, 'curso_id');
    }
}
