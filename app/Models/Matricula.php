<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsTo ;
class Matricula extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['fecha_matricula','fecha_matricula_final', 'estado','aplazado', 'nota_final', 'estudiante_id', 'teacher_id', 'grupo_id' , 'user_id'];

    public function student():belongsTo
    {
        return $this->belongsTo(Student::class, 'estudiante_id');
    }

    public function curso():belongsTo
    {
        return $this->belongsTo(Curso::class, 'grupo_id');
    }

    public function users():belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teacher():belongsTo
    {
        return $this->belongsTo(Theacher::class, 'teacher_id');
    }
}
