<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class PeriodoAcademico extends Model
{
    use HasFactory;

    protected $fillable = ['año', 'nombre', 'periodo', 'descripcion'];

    public function groups():hasMany
    {
        return $this->hasMany(group::class);
    }
}
