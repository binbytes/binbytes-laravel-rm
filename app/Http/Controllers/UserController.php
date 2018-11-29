<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Leave;
use App\Notifications\HolidayAdded;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserDesignationRequest;
use PDF;
use Yajra\Datatables\Datatables;
use Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
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
            return Datatables::of(User::query())
                ->addColumn('action', function (User $user) {
                    $data = [];
                    if(Gate::allows('show', $user)) {
                        $data['showUrl'] = route('users.show', $user);
                    }

                    if(Gate::allows('update', $user)) {
                        $data['editUrl'] = route('users.edit', $user);
                    }

                    if(Gate::allows('delete', $user)) {
                        $data['deleteUrl'] = route('users.destroy', $user);
                    }
                    return view('shared.dtAction', $data);
                })
                ->make(true);
        }

        return view('user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::pluck('title', 'id');

        return view('user.create', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        if(request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile();
        }

        if($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        $tags = $data['tag'] = explode(',', $request->get('tag'));

        $user = User::create($data);

        $user->attachTags($tags);

        if($request->has('designation_id')) {
            $user->designations()->attach(request('designation_id'));
        }

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'User has been created.');

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $weekAttendances = $user->week_attendances;
        $leaves = Leave::orderBy('start_date', 'desc')
                ->where('user_id', $user->id)
                ->get();

        return view('user.show', compact('user', 'weekAttendances', 'leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $designations = Designation::pluck('title', 'id');

        return view('user.update', compact('user', 'designations'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editMe()
    {
        $user = auth()->user();

        $weekAttendances = $user->week_attendances;
        $leaves = Leave::orderBy('start_date', 'desc')
            ->where('user_id', $user->id)
            ->get();

        return view('user.show', compact('user', 'weekAttendances', 'leaves'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();
        if(request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile();
        }

        if($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $tags = $data['tag'] = explode(',', $request->get('tag'));

        $user->fill($data)->save();

        $user->syncTags($tags);
        $user->designations()->sync(request('designation_id'));

        if(request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('alert-danger', 'User has been deleted.');

        return back();
    }

    /**
     * Upload user avatar
     *
     * @return mixed
     */
    protected function uploadFile()
    {
        return request('avatar')->store('users');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function experienceLetter(User $user)
    {
        return view('letter.experience', compact('user'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function joiningLetter(User $user)
    {
        return view('letter.joining', compact('user'));
    }


    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promote(User $user)
    {
        $designations = Designation::where('id', '<>', $user->designation->id)
                            ->pluck('title', 'id');

        return view('user.promote', compact('user', 'designations'));
    }

    /**
     * @param UserDesignationRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePromote(UserDesignationRequest $request, User $user)
    {
        $user->designations()
            ->attach(request('designation_id'), [
                'remarks' => request('remarks')
            ]);

        return redirect('/users');
    }

    /**
     * @param $letter
     * @param User $user
     * @return
     */
    public function download($letter, User $user)
    {
        //dd($letter);
        if($letter == "joiningLetter"){
            $pdf = PDF::loadView('letter.joining', compact('user'));

            return $pdf->download($user->username.'-joiningLatter.pdf');
        }

        if($letter == "promoteLetter") {
            $pdf = PDF::loadView('letter.promoteletter', compact('user'));

            return $pdf->download($user->username.'promoteLatter.pdf');
        }
    }
}
