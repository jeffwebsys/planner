<?php

namespace App\Policies;

use App\CellGroup;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CellGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\CellGroup  $cellGroup
     * @return mixed
     */
    public function view(User $user, CellGroup $cellGroup)
    {
        //
        return $user->id == $cellGroup->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\CellGroup  $cellGroup
     * @return mixed
     */
    public function update(User $user, CellGroup $cellGroup)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CellGroup  $cellGroup
     * @return mixed
     */
    public function delete(User $user, CellGroup $cellGroup)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\CellGroup  $cellGroup
     * @return mixed
     */
    public function restore(User $user, CellGroup $cellGroup)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CellGroup  $cellGroup
     * @return mixed
     */
    public function forceDelete(User $user, CellGroup $cellGroup)
    {
        //
    }
}
