<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Theacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TheacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_theacher');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Theacher $theacher): bool
    {
        return $user->can('view_theacher');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_theacher');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Theacher $theacher): bool
    {
        return $user->can('update_theacher');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Theacher $theacher): bool
    {
        return $user->can('delete_theacher');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_theacher');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Theacher $theacher): bool
    {
        return $user->can('force_delete_theacher');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_theacher');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Theacher $theacher): bool
    {
        return $user->can('restore_theacher');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_theacher');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Theacher $theacher): bool
    {
        return $user->can('replicate_theacher');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_theacher');
    }
}
