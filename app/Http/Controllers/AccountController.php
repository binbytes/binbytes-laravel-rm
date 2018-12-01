<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\AccountRequest;
use App\Transaction;
use App\User;
use Yajra\Datatables\Datatables;
use Gate;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Account::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        if(request()->ajax()) {
            return Datatables::of(Account::with('user'))
                ->addColumn('action', function (Account $account) {
                    $data = [];
                    if(Gate::allows('show', $account)) {
                        $data['showUrl'] = route('accounts.show', $account);
                    }

                    if(Gate::allows('update', $account)) {
                        $data['editUrl'] = route('accounts.edit', $account);
                    }

                    if(Gate::allows('delete', $account)) {
                        $data['deleteUrl'] = route('accounts.destroy', $account);
                    }

                    return view('shared.dtAction', $data);
                })
                ->make(true);
        }

        return view('account.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('username', 'id');

        return view('account.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $data = $request->all();

        Account::create($data);

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Account has been created.');

        return redirect('/accounts');
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(Account $account)
    {
        if(request()->ajax()) {
            $query = Transaction::where('account_id', $account->id);

            if((\request('month')) > 0) {
                $query = $query->whereMonth('date', \request('date'));
            }

            if(in_array(request('filter_type'), ['credit', 'debit'])) {
                $query->where(request('filter_type') . '_amount', '>', 0);
            }

            return Datatables::of($query)
                ->addColumn('credit_amount', function (Transaction $transaction) {
                    $data['credit_amount'] = $transaction->credit_amount;

                    return view('shared.formatAmount', $data);
                })
                ->addColumn('debit_amount', function (Transaction $transaction) {
                    $data['debit_amount'] = $transaction->debit_amount;

                    return view('shared.formatAmount', $data);
                })
                ->addColumn('closing_balance', function (Transaction $transaction) {
                    $data['closing_balance'] = $transaction->closing_balance;

                    return view('shared.formatAmount', $data);
                })
                ->addColumn('action', function (Transaction $transaction) {
                    return view('shared.dtAction', [
                        'showUrl' => route('transactions.show', $transaction),
                        'deleteUrl' => route('transactions.destroy', $transaction),
                        'editUrl' => route('transactions.edit', $transaction)
                    ]);
                })
                ->editColumn('description', function (Transaction $transaction) {
                    return $transaction->description;
                })
                ->editColumn('date', function (Transaction $transaction) {
                    return $transaction->date->format('Y-m-d');
                })
                ->rawColumns(['credit_amount', 'debit_amount', 'closing_balance', 'action'])
                ->make(true);
        }

        return view('account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $users = User::pluck('username', 'id');

        return view('account.update', compact('users', 'account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AccountRequest $request
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, Account $account)
    {
        $data = $request->all();

        $account->fill($data)->save();

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Account has been updated.');

        return redirect('/accounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Account $account)
    {
        $account->delete();

        session()->flash('alert-danger', 'Account has been deleted.');

        return back();
    }
}
