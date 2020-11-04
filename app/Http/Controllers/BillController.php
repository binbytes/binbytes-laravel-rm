<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Client;
use App\Http\Requests\BillRequest;
use App\Project;
use Yajra\Datatables\Datatables;

class BillController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Bill::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            $start = (\request('start_date'));
            $end = (\request('end_date')) ? (\request('end_date')) : (\request('start_date'));

            $query = Bill::with('client', 'project');

            if ($start && $end) {
                $query = $query->whereBetween('date', [$start, $end]);
            }

            if (\request('client_id')) {
                $query->where('client_id', \request('client_id'));
            }

            if (\request('project_id')) {
                $query->where('project_id', \request('project_id'));
            }

            return Datatables::of($query)
                ->addColumn('action', function (Bill $bill) {
                    $data = [
                        'target' => '_blank',
                        'billUrl' => route('download-bill', $bill),
                    ];

                    return view('shared.dtAction', $data);
                })
                ->editColumn('client', function (Bill $bill) {
                    return $bill->client ? $bill->client->name : '';
                })
                ->editColumn('project', function (Bill $bill) {
                    return $bill->project ? $bill->project->title: '';
                })
                ->editColumn('date', function (Bill $bill) {
                    return $bill->date->format('Y-m-d');
                })
                ->rawColumns(['client', 'action', 'project', 'date'])
                ->make(true);
        }

        $clients = Client::pluck('name', 'id');

        $projects = Project::pluck('title', 'id');

        return view('invoice.list', compact('clients', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BillRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BillRequest $request)
    {
        $data = $request->all();

        $bill = Bill::create($data);

        return response()->json($bill);
    }

    public function downloadBill($bill) {

        $bill = Bill::with('project', 'client')->find($bill);

        $pdf = \PDF::loadView('letter.billPdf', [
            'bill' => $bill
        ]);

        $prefix = $bill->project !== null ? $bill->project->invoice_prefix : 'BB';

        $filename = 'Invoice-'.$prefix.'-'.$bill->id;

        return $pdf->stream($filename.'.pdf');
    }
}
