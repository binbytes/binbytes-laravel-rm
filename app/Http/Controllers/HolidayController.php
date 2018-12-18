<?php

namespace App\Http\Controllers;

use App\Events\HolidayAdded;
use App\Holiday;
use App\Http\Requests\HolidayRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Gate;

class HolidayController extends Controller
{
    /**
     * HolidayController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Holiday::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        return view('holiday.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('holiday.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HolidayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayRequest $request)
    {
        $data = $request->all();

        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);

        $holiday = Holiday::create($data);
        event(new HolidayAdded($holiday));

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Holiday has been created.');

        return redirect('/holidays');
    }

    /**
     * Display the specified resource.
     *
     * @param Holiday $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        return view('holiday.show', compact('holiday'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Holiday $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        return view('holiday.update', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Holiday $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $data = $request->all();

        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);

        $holiday->fill($data)->save();
        event(new HolidayAdded($holiday));

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Holiday has been updated.');

        return redirect('/holidays');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Holiday $holiday
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-danger', 'Holiday has been deleted.');

        return back();
    }

    /**
     *
     */
    public function getHolidayAPI()
    {
        $query = Holiday::query();

        return \App\Http\Resources\Holiday::collection($query->get());
    }
}
