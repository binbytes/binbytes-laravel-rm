<?php

namespace App\Http\Controllers;

use App\TransactionType;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TransactionTypeRequest;

class TransactionTypeController extends Controller
{
    /**
     * HolidayController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(TransactionType::class);
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
            return Datatables::of(TransactionType::query())
                ->addColumn('parent_id', function (TransactionType $transactionType) {
                    return $transactionType->parent_id ? $transactionType->transactionType->title : null;
                })
                ->addColumn('action', function (TransactionType $transactionType) {
                    return view('shared.dtAction', [
                        'deleteUrl' => route('transaction-types.destroy', $transactionType),
                        'editUrl' => route('transaction-types.edit', $transactionType),
                    ]);
                })
                ->rawColumns(['parent_id', 'action'])
                ->make(true);
        }

        return view('transaction_type.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactionTypes = TransactionType::pluck('title', 'id');

        return view('transaction_type.create', compact('transactionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionTypeRequest $request)
    {
        $data = $request->all();

        TransactionType::create($data);

        if (request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Transaction Type has been created.');

        return redirect('/transaction-types');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TransactionType $transactionType
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionType $transactionType)
    {
        $transactionTypes = TransactionType::where('id', '<>', $transactionType->id)->pluck('title', 'id');

        return view('transaction_type.update', compact('transactionType', 'transactionTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TransactionTypeRequest $request
     * @param TransactionType $transactionType
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionTypeRequest $request, TransactionType $transactionType)
    {
        $data = $request->all();

        $transactionType->fill($data)->save();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Transaction Type has been updated.');

        return redirect('/transaction-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TransactionType $transactionType
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TransactionType $transactionType)
    {
        $transactionType->delete();

        session()->flash('alert-danger', 'Transaction Type has been deleted.');

        if (\request()->ajax()) {
            return response()->json([]);
        }

        return back();
    }
}
