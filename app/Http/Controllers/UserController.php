<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
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
        return view('user.create');
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

        $data['password'] = bcrypt($data['password']);

        User::create($data);

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
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.update', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editMe()
    {
        $user = auth()->user();

        return view('user.update', compact('user'));
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

        $user->fill($data)->save();

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
        return request('avatar')->store('users', 'public');
    }
}
