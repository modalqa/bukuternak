<?php

namespace App\Policies;

use App\Models\Cycle;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CyclePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Cycle $cycle): bool
    {
        return $user->id === $cycle->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Cycle $cycle): bool
    {
        return $user->id === $cycle->user_id;
    }

    public function delete(User $user, Cycle $cycle): bool
    {
        return $user->id === $cycle->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cycle $cycle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cycle $cycle): bool
    {
        return false;
    }
}
