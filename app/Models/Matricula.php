<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matricula extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['fecha_matricula', 'estado', 'nota_final', 'estudiante_id', 'teacher_id', 'grupo_id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'estudiante_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'grupo_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }
}
