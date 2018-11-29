<?php

namespace App\Policies;

use App\User;
use App\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
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
     * Determine whether the user can view the account.
     *
     * @param  \App\User  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function view(User $user, Account $account)
    {
        return false;
    }

    /**
     * Determine whether the user can create accounts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the account.
     *
     * @param  \App\User  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function update(User $user, Account $account)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the account.
     *
     * @param  \App\User  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function delete(User $user, Account $account)
    {
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function show(User $user)
    {
        return false;
    }
}
