<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if($user->isAccountant()) {
            return false;
        }
    }

    /**
     * Determine whether the user can view the projects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can show the model.
     *
     * @param  \App\User $user
     * @param User $model
     * @return mixed
     */
    public function show(User $user, User $model)
    {
        return $model->id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $model->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return false;
    }

    /**
     * Can change organization detail
     * @param \App\User $user
     *
     * @return bool
     */
    public function organizationDetail(User $user)
    {
        return false;
    }

    /**
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function userInfoTab(User $user, User $model)
    {
        return $model->id === $user->id;
    }

    /**
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function seeWeeklyAttendance(User $user, User $model)
    {
        return $model->id === $user->id;
    }
}
