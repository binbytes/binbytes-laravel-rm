<?php

namespace App\Policies;

use App\User;
use App\Leave;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeavePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the leaves.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function view(User $user, Leave $leave)
    {
        return true;
    }

    /**
     * Determine whether the user can create leaves.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can show leaves.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function show(User $user, Leave $leave)
    {
        return $user->id == $leave->user_id;
    }

    /**
     * Determine whether the user can update the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function update(User $user, Leave $leave)
    {
        return $user->id == $leave->user_id;
    }

    /**
     * Determine whether the user can delete the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function delete(User $user, Leave $leave)
    {
        return $user->id == $leave->user_id;
    }
}
