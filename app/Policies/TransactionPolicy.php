<?php

namespace App\Policies;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isAccountant()) {
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
        return true;
    }

    /**
     * Determine whether the user can view the transaction.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create transactions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the transaction.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the transaction.
     *
     * @param  \App\User  $user
     * @param  \App\Transaction  $transaction
     * @return mixed
     */
    public function delete(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->account->user_id;
    }

    /**
     * Determine whether the user can show the transaction.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function show(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->account->user_id;
    }

    /**
     * @param User $user
     * @param Transaction $transaction
     * @return bool
     */
    public function download(user $user, Transaction $transaction)
    {
        return $user->id === $transaction->account->user_id;
    }

    /**
     * @param User $user
     * @param Transaction $transaction
     * @return bool
     */
    public function bill(user $user, Transaction $transaction)
    {
        return false;
    }
}
