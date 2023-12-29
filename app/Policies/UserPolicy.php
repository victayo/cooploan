<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $actor, User $model): bool
    {
        return ($actor->mainone_id == $model->mainone_id) || $actor->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can send a registration link
     */
    public function sendLink(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $actor, User $model): bool
    {
        return $actor->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $actor, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $actor, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $actor, User $model): bool
    {
        return false;
    }
}
