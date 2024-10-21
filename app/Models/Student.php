<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['Documento', 'user_id', 'direccion', 'telefono'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
