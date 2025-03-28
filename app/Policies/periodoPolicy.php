<?php

namespace App\Policies;

use App\Models\User;
use App\Models\periodoAcademico;
use Illuminate\Auth\Access\Response;

class periodoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_periodo::academico');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, periodoAcademico $periodoAcademico): bool
    {
        return $user->can('view_periodo::academico');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_periodo::academico');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, periodoAcademico $periodoAcademico): bool
    {
        return $user->can('update_periodo::academico');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, periodoAcademico $periodoAcademico): bool
    {
        return $user->can('delete_periodo::academico');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, periodoAcademico $periodoAcademico): bool
    {
        return $user->can('restore_periodo::academico');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, periodoAcademico $periodoAcademico): bool
    {
        return $user->can('force_delete_periodo::academico');
    }
}
