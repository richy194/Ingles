<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GrupoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // El usuario debe tener el permiso 'view_any_group' para ver cualquier grupo.
        return $user->can('view_any_group');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Group $group): bool
    {
        // El usuario debe tener el permiso 'view_group' para ver un grupo específico.
        return $user->can('view_group');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // El usuario debe tener el permiso 'create_group' para crear un grupo.
        return $user->can('create_group');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Group $group): bool
    {
        // El usuario debe tener el permiso 'update_group' para actualizar el grupo.
        return $user->can('update_group');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Group $group): bool
    {
        // El usuario debe tener el permiso 'delete_group' para eliminar el grupo.
        return $user->can('delete_group');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Group $group): bool
    {
        // El usuario debe tener el permiso 'restore_group' para restaurar el grupo.
        return $user->can('restore_group');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Group $group): bool
    {
        // El usuario debe tener el permiso 'force_delete_group' para eliminar permanentemente el grupo.
        return $user->can('force_delete_group');
    }
}
