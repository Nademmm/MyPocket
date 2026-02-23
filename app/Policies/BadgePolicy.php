<?php

namespace App\Policies;

use App\Models\SavingDiary;
use App\Models\User;

class SavingDiaryPolicy
{
    /**
     * Determine whether the user can view the diary.
     */
    public function view(User $user, SavingDiary $diary): bool
    {
        return $user->id === $diary->user_id;
    }

    /**
     * Determine whether the user can update the diary.
     */
    public function update(User $user, SavingDiary $diary): bool
    {
        return $user->id === $diary->user_id;
    }

    /**
     * Determine whether the user can delete the diary.
     */
    public function delete(User $user, SavingDiary $diary): bool
    {
        return $user->id === $diary->user_id;
    }
}
