<?php

namespace App\Http\Controllers;

use App\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
     */
    public function index()
    {
        $leaves = Leave::with('user')->latest()->paginate();

        return view('leave.list', compact('leaves'));
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

        Leave::create($data);

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Leave has been created.');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

        session()->flash('alert-danger', 'Client has been deleted.');

        return back();
    }
}
