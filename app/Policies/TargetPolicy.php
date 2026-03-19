<?php

namespace App\Policies;

use App\Models\Target;
use App\Models\User;

class TargetPolicy
{
    /**
     * Determine whether the user can view the target.
     */
    public function view(User $user, Target $target): bool
    {
        return $user->id === $target->user_id;
    }

    /**
     * Determine whether the user can update the target.
     */
    public function update(User $user, Target $target): bool
    {
        return $user->id === $target->user_id;
    }

    /**
     * Determine whether the user can delete the target.
     */
    public function delete(User $user, Target $target): bool
    {
        return $user->id === $target->user_id;
    }
}
