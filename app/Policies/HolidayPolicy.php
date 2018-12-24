<?php

namespace App\Policies;

use App\User;
use App\Holiday;
use Illuminate\Auth\Access\HandlesAuthorization;

class HolidayPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isAccountant()) {
            return false;
        }
    }

    /**
     * Determine whether the user can view the holidays.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the holiday.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create holidays.
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
     * @return mixed
     */
    public function show(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the holiday.
     *
     * @param  \App\User  $user
     * @param  \App\Holiday  $holiday
     * @return mixed
     */
    public function update(User $user, Holiday $holiday)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the holiday.
     *
     * @return mixed
     */
    public function delete()
    {
        return false;
    }

    public function calender()
    {
        return true;
    }
}
