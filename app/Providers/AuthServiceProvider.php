<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Group;
use App\Policies\GrupoPolicy;
 use Illuminate\Support\Facades\Gate;
use App\Models\Matricula;
use App\Policies\MatriculaPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Group::class => GrupoPolicy::class,
        Matricula::class => MatriculaPolicy::class, // Registro de la política
    ];

    /**
     * Register any authentication / authorization services.
     */
    
       

public function boot()
 {
    $this->registerPolicies();

    // Aquí puedes registrar los permisos manualmente, por ejemplo:
    Gate::define('update_matricula', function ($user) {
        // Lógica para decidir si el usuario puede actualizar una matrícula
        return $user->hasRole('admin'); // Ejemplo, cambiar según tus necesidades
    });

    Gate::define('delete_matricula', function ($user) {
        // Lógica para decidir si el usuario puede eliminar una matrícula
        return $user->hasRole('admin'); // Ejemplo, cambiar según tus necesidades
    });
 }
    
}
