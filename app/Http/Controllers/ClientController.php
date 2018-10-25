<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use Yajra\Datatables\Datatables;

class ClientController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        if(request()->ajax()) {
            return Datatables::of(Client::query())
                ->addColumn('action', function (Client $client) {
                    return view('shared.dtAction', [
                        'updateUrl' => route('clients.show', $client),
                        'deleteUrl' => route('clients.destroy', $client)
                    ]);
                })
                ->make(true);
        }

        return view('client.list', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $data = $request->all();
        if(request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile();
        }

        Client::create($data);

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Client has been created.');

        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.show', compact('client'));
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
     * @param  ClientRequest  $request
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $data = $request->all();
        if(request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile();
        }

        $client->fill($data)->save();

        if(request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        $client->delete();

        session()->flash('alert-danger', 'Client has been deleted.');

        return back();
    }

    protected function uploadFile()
    {
        return request('avatar')->store('clients', 'public');
    }
}
