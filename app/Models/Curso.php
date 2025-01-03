<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre', 'codigo', 'descripcion', 'nivel_curso', 
        'fecha_inicio', 'fecha_fin', 'requisito', 'modalidad', 
        'periodo_id', 'teacher_id'
    ];

    // Relación con el PeriodoAcademico
    public function periodo()
    {
        return $this->belongsTo(PeriodoAcademico::class, 'periodo_id');
    }

    // Relación con el Teacher (Profesor)
    public function teacher()
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }

    // Relación con el curso requisito (curso previo necesario)
    public function requisitoCurso()
    {
        return $this->belongsTo(Curso::class, 'requisito', 'id'); // Relaciona el curso con su requisito
    }

    public function requisito()
    {
        // Relación de un curso con el curso requisito
        return $this->belongsTo(Curso::class, 'requisito');
    }

    // Relación recursiva para obtener los cursos que dependen de este curso
    public function cursosDependientes()
    {
        return $this->hasMany(Curso::class, 'requisito');
    }

    // Relación con los grupos del curso
    public function grupos()
    {
        return $this->hasMany(Group::class, 'curso_id');
    }

    // Relación con las matrículas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'curso_id'); // Relaciona con la tabla matriculas, usando 'curso_id'
    }

    // Relación con FormularioInscripcion
    public function formularios()
    {
        return $this->hasMany(FormularioInscripcion::class, 'curso_id'); // Relaciona con la tabla formulario_inscripciones, usando 'curso_id'
    }
}
