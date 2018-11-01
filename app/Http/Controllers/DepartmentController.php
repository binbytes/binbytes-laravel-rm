<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use App\Department;
use Yajra\Datatables\Datatables;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Department::class);
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
            return Datatables::of(Department::query())
                ->addColumn('action', function (Department $department) {
                    return view('shared.dtAction', [
                        'showUrl' => route('departments.show', $department),
                        'deleteUrl' => route('departments.destroy', $department),
                        'editUrl' => route('departments.edit', $department)
                    ]);
                })
                ->make(true);
        }

        return view('department.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $data = $request->all();

        Department::create($data);

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Department has been created.');

        return redirect('/departments');
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
     * @param Department $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.update', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->all();

        $department->fill($data)->save();

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Department has been updated.');

        return redirect('/departments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Department $department)
    {
        $department->delete();

        session()->flash('alert-danger', 'Department has been deleted.');

        return back();
    }
}
