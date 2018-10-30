<?php

namespace App\Http\Controllers;

use App\Events\LeaveApproval;
use App\Events\LeaveRequested;
use App\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\LeaveRequest;
use Yajra\Datatables\Datatables;
use Gate;

class LeaveController extends Controller
{
    /**
     * LeaveController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Leave::class);
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
            return Datatables::of(Leave::with('user')
                    ->when(auth()->user()->isAdmin() === false, function ($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->newQuery()
                )
                ->addColumn('approved', function (Leave $leave) {
                    if($leave->is_approved === null && Gate::allows('approval', $leave)) {
                        $data = [];
                        $data['approvedUrl'] = url("leave-approval/{$leave->id}/1");
                        $data['notApprovedUrl'] = url("leave-approval/{$leave->id}/0");

                        return view('shared.approved', $data);
                    }

                    return $leave->approval_status;
                })
                ->addColumn('action', function (Leave $leave) {
                    $data = [];
                    if(Gate::allows('show', $leave)) {
                        $data['showUrl'] = route('leaves.show', $leave);
                    }

                    if (Gate::allows('update', $leave)) {
                        $data['editUrl'] = route('leaves.update', $leave);
                    }

                    if (Gate::allows('delete', $leave)) {
                        $data['deleteUrl'] = route('leaves.destroy', $leave);
                    }

                    return view('shared.dtAction', $data);
                })
                ->rawColumns(['approved', 'action'])
                ->make(true);
        }

        return view('leave.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LeaveRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);

        $leave = Leave::create($data);

        event(new LeaveRequested($leave));

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Leave request has been created.');

        return redirect('/leaves');
    }

    /**
     * Display the specified resource.
     *
     * @param Leave $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        return view('leave.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Leave $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        return view('leave.update', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Leave $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);

        $leave->fill($data)->save();

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Leave has been updated.');

        return redirect('/leaves');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Leave $leave
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        session()->flash('alert-danger', 'Leave has been deleted.');

        return back();
    }

    /**
     * Approve/Reject Leave Request
     *
     * @param Leave $leave
     * @param $approve
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approved(Leave $leave, $approve)
    {
        $data = [];

        $data['is_approved'] = $approve == 1;
        $data['approved_by'] = auth()->id();
        $data['approved_on'] = now();

        $leave->fill($data)->save();

        event(new LeaveApproval($leave));

        return back();
    }
}
