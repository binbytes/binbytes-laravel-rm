<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Http\Requests\BillRequest;
use Gate;
use App\Account;
use App\Transaction;
use App\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use App\Exports\TransactionExport;
use App\Imports\TransactionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Transaction::class);
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

                    if (Gate::allows('show', $transaction)) {
                        $data['showUrl'] = route('transactions.show', $transaction);
                    }

                    if (Gate::allows('update', $transaction)) {
                        $data['editUrl'] = route('transactions.edit', $transaction);
                    }

                    if (Gate::allows('delete', $transaction)) {
                        $data['deleteUrl'] = route('transactions.destroy', $transaction);
                    }

                    return view('shared.dtAction', $data);
                })
                ->editColumn('account', function (Transaction $transaction) {
                    return $transaction->account->name;
                })
                ->editColumn('type', function (Transaction $transaction) {
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

        if (request()->hasFile('invoice')) {
            $data['invoice'] = $this->storeFile();
        }

        $transaction = Transaction::create($data);

        if (request()->wantsJson()) {
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
    public function show($transaction)
    {
        $transaction = Transaction::with('transactionType')->find($transaction);

        $transactional = [];

        if ($transaction->transactional_type) {
            foreach (config('rm.target_models') as $key => $value) {
                if ($transaction->transactional_type == $key && $transaction->transactional_id) {
                    $type = $value;
                    $person = $key::find($transaction->transactional_id);

                    if ($type == 'Project') {
                        $transactionalPerson = $person->title;
                    } else {
                        $transactionalPerson = $person->name;
                    }

                    $transactional = [
                        'type' => $type,
                        'person' => $transactionalPerson,
                    ];
                }
            }
        }

        if (\request()->ajax()) {
            return response()->json([
                'transaction' => $transaction,
                'transactionalTypes' => $transactional,
            ]);
        }

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
            'both', $transaction->isCredit() ? 'credit' : 'debit',
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

        if (request()->hasFile('invoice')) {
            $data['invoice'] = $this->storeFile();
        }

        $transaction->fill($data)->save();

        if (request()->wantsJson()) {
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
        $accountId = $transaction->account->id;
        $transaction->delete();

        session()->flash('alert-danger', 'Transaction has been deleted.');

        if (\request()->ajax()) {
            return response()->json([]);
        }

        return redirect(url('accounts', $accountId));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteAll()
    {
        if ($ids = \request('ids')) {
            foreach ($ids as $id) {
                if ($transaction = Transaction::find($id)) {
                    $this->authorize('delete', $transaction);
                    $transaction->delete();
                }
            }
        }

        if (\request()->ajax()) {
            return response()->json([]);
        }

        return redirect(url('accounts'));
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        $start = (\request('start_date'));
        $end = (\request('end_date')) ? (\request('end_date')) : (\request('start_date'));

        $query = Transaction::where('account_id', \request('account_id'));

        if ($start && $end) {
            $query = $query->whereBetween('date', [$start, $end]);
        }

        $amountValue = request('amount', 0);
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

        $transactions = $query->get();

        $transactions = collect($transactions)->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'date' => $transaction->date->format('d-m-Y'),
                'description' => $transaction->description,
                'reference' => $transaction->reference,
                'credit_amount' => $transaction->credit_amount,
                'debit_amount' => $transaction->debit_amount,
                'closing_balance' => $transaction->closing_balance,
                'note' => $transaction->note,
                'invoice' => $transaction->invoice ? \Storage::url($transaction->invoice) : null,
            ];
        });

        $fileName = 'Transaction-'.str_replace('-', '', $start).'-'.str_replace('-', '', $end);

        if (\request('btn') === 'pdf') {
            $pdf = \PDF::loadView('letter.transactionPdf', [
                'transactions' => $transactions,
                'start' => $start,
                'end' => $end
            ]);

            return $pdf->setPaper('a4', 'landscape')->download($fileName.'.pdf');
        } else {
            $transactions->push([
                'id' => '',
                'date' => '',
                'description' => '',
                'reference' => 'Total Amount',
                'credit_amount' => $transactions->sum('credit_amount'),
                'debit_amount' => $transactions->sum('debit_amount')
            ]);
            return (new TransactionExport($transactions))->download($fileName.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
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

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAPI()
    {
        return \App\Http\Resources\Transaction::collection(Transaction::with('account')->get());
    }

    public function bill(BillRequest $request) {
        $data = $request->all();

        $bill = Bill::create($data);

        return response()->json($bill);
    }

    public function downloadBill($bill) {

        $bill = Bill::with('project', 'client')->find($bill);

        $pdf = \PDF::loadView('letter.billPdf', [
            'bill' => $bill
        ]);

        $prefix = $bill->project === null ? $bill->project->invoice_prefix : 'BB';

        $filename = 'Invoice-'.$prefix.'-'.$bill->id;

        return $pdf->setPaper('a4', 'landscape')->download($filename.'.pdf');
    }
}
