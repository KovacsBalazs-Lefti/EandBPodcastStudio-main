<?php

namespace App\Policies;

use App\Models\Foglalas;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FoglalasPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //szerepkör oszlop felvétel opciója
        // role: admin, user
        // return $user->role == "admin"

        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Foglalas $foglalas): bool
    {
        //minden felhasználó saját foglalasat tekintheti meg
        return $user->felhasznaloid == $foglalas->user_felhasznaloid;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Foglalas $foglalas): bool
    {
        return $user->felhasznaloid == $foglalas->user_felhasznaloid;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Foglalas $foglalas): bool
    {
        return $user->felhasznaloid == $foglalas->user_felhasznaloid;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Foglalas $foglalas): bool
    {
        return $user->felhasznaloid == $foglalas->user_felhasznaloid;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Foglalas $foglalas): bool
    {
        return true;
    }
}
