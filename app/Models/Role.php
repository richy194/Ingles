<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends ModelsRole
{
    use HasFactory, SoftDeletes;
}
