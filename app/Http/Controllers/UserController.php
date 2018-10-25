<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate();

        return view('user.list', compact('users'));
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

    protected function uploadFile()
    {
        return request('avatar')->store('users', 'public');
    }
}
