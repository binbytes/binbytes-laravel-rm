<?php

namespace App\Http\Controllers;

use App\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\LeaveApproval;
use App\Events\LeaveRequested;
use App\Http\Requests\LeaveRequest;

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

        if ($data['end_date'] == null) {
            $data['end_date'] = $data['start_date'];
        }
        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);

        $leave = Leave::create($data);

        event(new LeaveRequested($leave));

        if (request()->wantsJson()) {
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
        if ($data['end_date'] == null) {
            $data['end_date'] = $data['start_date'];
        }
        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);

        $leave->fill($data)->save();

        if (request()->wantsJson()) {
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

        if (request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-danger', 'Leave has been deleted.');

        return back();
    }

    /**
     * Approve/Reject Leave Request.
     *
     * @param Leave $leave
     * @param $approve
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function approved(Leave $leave, $approve)
    {
        $this->authorize('approval', $leave);

        $data = [];

        $data['is_approved'] = $approve == true;
        $data['approved_by'] = auth()->id();
        $data['approved_on'] = now();

        $leave->fill($data)->save();

        event(new LeaveApproval($leave));

        if (\request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getLeaveAPI()
    {
        return \App\Http\Resources\Leave::collection(Leave::with('user')->get());
    }
}
