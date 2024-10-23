<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Matricula;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatriculaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_matricula');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Matricula $matricula): bool
    {
        return $user->can('view_matricula');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_matricula');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Matricula $matricula): bool
    {
        return $user->can('update_matricula');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Matricula $matricula): bool
    {
        return $user->can('delete_matricula');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_matricula');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Matricula $matricula): bool
    {
        return $user->can('force_delete_matricula');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_matricula');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Matricula $matricula): bool
    {
        return $user->can('restore_matricula');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_matricula');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Matricula $matricula): bool
    {
        return $user->can('replicate_matricula');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_matricula');
    }
}
