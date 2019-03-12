<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use App\Account;
use App\Client;
use App\Project;
use App\Transaction;
use App\TransactionType;
use Yajra\Datatables\Datatables;
use App\Http\Requests\AccountRequest;

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
        if (request()->ajax()) {
            if (Gate::allows('accessAll', Account::class)) {
                $query = Account::with('user');
            } else {
                $query = Account::with('user')
                            ->where('user_id', auth()->id());
            }

            return Datatables::of($query)
                ->addColumn('action', function (Account $account) {
                    $data = [];
                    if (Gate::allows('show', $account)) {
                        $data['showUrl'] = route('accounts.show', $account);
                    }

                    if (Gate::allows('update', $account)) {
                        $data['editUrl'] = route('accounts.edit', $account);
                    }

                    if (Gate::allows('delete', $account)) {
                        $data['deleteUrl'] = route('accounts.destroy', $account);
                    }

                    return view('shared.dtAction', $data);
                })
                ->editColumn('user', function (Account $account) {
                    return $account->user->name;
                })
                ->rawColumns(['user', 'action'])
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

        if (request()->wantsJson()) {
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
        if (request()->ajax()) {
            $query = Transaction::where('account_id', $account->id);

            if ((\request('month')) > 0) {
                $query = $query->whereMonth('date', \request('date'));
            }

            if ((\request('year')) > 0) {
                $query = $query->whereYear('date', \request('year'));
            }

            $amountValue = request('amount_value', 0);
            $operator = request('operator', '>');
            $filterType = request('filter_type');

            if (in_array($filterType, [
                    'credit_amount', 'debit_amount', 'closing_balance',
            ])) {
                $query->where($filterType, $operator, $amountValue);
            } else {
                if ($amountValue > 0) {
                    $query->where(function ($q) use ($amountValue, $operator) {
                        $q->where(function ($q) use ($amountValue, $operator) {
                            $q->where('credit_amount', '>', 0)
                                ->where('credit_amount', $operator, $amountValue);
                        })
                        ->orWhere(function ($q) use ($amountValue, $operator) {
                            $q->where('debit_amount', '>', 0)
                                ->where('debit_amount', $operator, $amountValue);
                        });
                    });
                }
            }

            if (\request('invoice') == 'with_invoice') {
                $query->withInvoice();
            } elseif (\request('invoice') == 'without_invoice') {
                $query->withoutInvoice();
            }

            return Datatables::of($query)
                ->addColumn('select', function (Transaction $transaction) {
                    return "<input type='checkbox' class='chk-transaction' value='".$transaction->id."'>";
                })
                ->editColumn('credit_amount', function (Transaction $transaction) {
                    $data['credit_amount'] = $transaction->credit_amount;

                    return view('shared.formatAmount', $data);
                })
                ->editColumn('debit_amount', function (Transaction $transaction) {
                    $data['debit_amount'] = $transaction->debit_amount;

                    return view('shared.formatAmount', $data);
                })
                ->editColumn('closing_balance', function (Transaction $transaction) {
                    $data['closing_balance'] = $transaction->closing_balance;

                    return view('shared.formatAmount', $data);
                })
                ->addColumn('action', function (Transaction $transaction) {
                    $data = [
                        'id' => $transaction->id,
                        'showUrl' => route('transactions.show', $transaction),
                    ];

                    if (Gate::allows('update', $transaction)) {
                        $data['editUrl'] = route('transactions.edit', $transaction);
                    }
                    if (Gate::allows('delete', $transaction)) {
                        $data['deleteUrl'] = route('transactions.destroy', $transaction);
                    }
                    if (Gate::allows('download', $transaction)) {
                        if ($transaction->invoice) {
                            $data['downloadUrl'] = route('transaction-download', $transaction->id);
                        }
                    }

                    return view('shared.dtAction', $data);
                })
                ->editColumn('date', function (Transaction $transaction) {
                    return $transaction->date->format('j-n-y');
                })
                ->editColumn('type', function (Transaction $transaction) {
                    return $transaction->type ? $transaction->transactionType->title : null;
                })
                ->rawColumns(['date', 'select', 'credit_amount', 'debit_amount', 'closing_balance', 'action'])
                ->make(true);
        }

        $users = User::pluck('username', 'id');

        $clients = Client::pluck('name', 'id');

        $projects = Project::pluck('title', 'id');

        return view('account.show', compact('account', 'users', 'clients', 'projects'));
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

        if (request()->wantsJson()) {
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

        if (\request()->ajax()) {
            return response()->json([]);
        }

        return back();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAPI()
    {
        $accounts = Account::pluck('name', 'id');

        $transactionTypes = TransactionType::all();

        $transactionalTypes = config('rm.target_models');

        return response()->json([
            'accounts' => $accounts,
            'transactionTypes' => $transactionTypes,
            'transactionalTypes' => $transactionalTypes,
        ]);
    }
}
