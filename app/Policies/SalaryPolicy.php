<?php

namespace App\Policies;

use App\User;
use App\Salary;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalaryPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
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
     * Determine whether the user can view the client.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the salary.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return false;
    }


    /**
     * Determine whether the user can create salaries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the salary.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the salary.
     *
     * @param  \App\User  $user
     * @param  \App\Salary  $salary
     * @return mixed
     */
    public function delete(User $user, Salary $salary)
    {
        return false;
    }

    /**
     * Determine whether the user can view the salary.
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
     * @param User $user
     * @return bool
     */

    public function paidSalary(User $user)
    {
        return false;
    }

}
