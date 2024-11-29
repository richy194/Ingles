<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\hasMany ;

class Student extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = ['nombre', 'email','Documento', 'direccion' ,'telefono'];
    
    public function matriculas():hasMany
    {
        return $this->hasMany(Matricula::class);
    }
}
