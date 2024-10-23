<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = ['Documento', 'user_id', 'direccion','correo' ,'telefono'];
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
