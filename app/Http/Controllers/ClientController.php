<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use Yajra\Datatables\Datatables;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Client::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        if(request()->ajax()) {
            return Datatables::of(Client::query()->orderBy('priority', 'asc'))
                ->addColumn('action', function (Client $client) {
                    return view('shared.dtAction', [
                        'showUrl' => route('clients.show', $client),
                        'deleteUrl' => route('clients.destroy', $client),
                        'editUrl' => route('clients.edit', $client)
                    ]);
                })
                ->make(true);
        }

        return view('client.list');
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

        $tags = $data['tag'] = explode(',', $request->get('tag'));
        $client = Client::create($data);
        $client->attachTags($tags);

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
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.update', compact('client'));
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

        $tags = $data['tag'] = explode(',', $request->get('tag'));
        $client->fill($data)->save();
        $client->syncTags($tags);

        if(request()->wantsJson()) {
            return response([], 200);
        }

        session()->flash('alert-success', 'Client has been updated.');

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
        return request('avatar')->store('clients');
    }
}
