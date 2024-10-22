<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theacher extends Model
{

    protected $fillable = ['nombre', 'email', 'telefono', 'user_id','direccion '];
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'teacher_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'teacher_id');
    }
}
