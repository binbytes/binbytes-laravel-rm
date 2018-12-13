<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\TransactionRequest;
use App\Imports\TransactionImport;
use App\TransactionType;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Transaction;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Gate;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Transaction::class);
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
            if(Gate::allows('accessAll', Account::class)) {
                $query = Transaction::with('account');
            } else {
                $query = Transaction::with('account')
                            ->whereHas('account', function ($query) {
                                return $query->where('user_id', auth()->id());
                            });
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
                    $data = [];

                    if(Gate::allows('show', $transaction)) {
                        $data['showUrl'] = route('transactions.show', $transaction);
                    }

                    if(Gate::allows('update', $transaction)) {
                        $data['editUrl'] = route('transactions.edit', $transaction);
                    }

                    if(Gate::allows('delete', $transaction)) {
                        $data['deleteUrl'] = route('transactions.destroy', $transaction);
                    }

                    return view('shared.dtAction', $data);
                })
                ->editColumn('account', function (Transaction $transaction){
                    return $transaction->account->name;
                })
                ->editColumn('type', function (Transaction $transaction){
                    return $transaction->type ? $transaction->transactionType->title : null;
                })
                ->editColumn('description', function (Transaction $transaction) {
                    return substr($transaction->description, 0, 15);
                })
                ->editColumn('date', function (Transaction $transaction) {
                    return $transaction->date->format('Y-m-d');
                })
                ->rawColumns(['credit_amount', 'debit_amount', 'closing_balance', 'action'])
                ->make(true);
        }

        return view('transaction.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::pluck('name', 'id');

        $transactionTypes = TransactionType::pluck('title', 'id');

        return view('transaction.create', compact('accounts', 'transactionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();

        if(request()->hasFile('invoice')) {
            $data['invoice'] = $this->storeFile();
        }

        $transaction = Transaction::create($data);

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Transaction has been created.');

        return redirect(url('accounts', $transaction->account->id));
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $accounts = Account::pluck('name', 'id');

        $transactionTypes = TransactionType::whereIn('transaction_type', [
            'both', $transaction->isCredit() ? 'credit' : 'debit'
        ])->pluck('title', 'id');

        return view('transaction.update', compact('accounts', 'transaction', 'transactionTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TransactionRequest $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->all();

        if(request()->hasFile('invoice')) {
            $data['invoice'] = $this->storeFile();
        }

        $transaction->fill($data)->save();

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Transaction has been updated.');

        return redirect(url('accounts', $transaction->account->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        session()->flash('alert-danger', 'Transaction has been deleted.');

        return redirect(url('accounts', $transaction->account->id));
    }

    /**
     * @param Account $account
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function import(Account $account)
    {
        $this->authorize('importTransactions', $account);

        Excel::import(new TransactionImport($account), \request('file'), null, $account->statementReaderType());

        return redirect(url('accounts', $account->id));
    }

    /**
     * @return mixed
     */
    protected function storeFile()
    {
        return request('invoice')->store('invoices');
    }

    /**
     * @param Transaction $transaction
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Transaction $transaction)
    {
        return Storage::download($transaction->invoice);
    }
}
