@extends('layouts.app', [
    'pageTitle' => 'Clients'
])

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="/clients/create" class="btn btn-primary pull-right">
                        <i class="fa fa-plus mr-2"></i>
                        Add Client
                    </a>
                </div>
                <div class="card-body p-0 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Client</th>
                                <th scope="col">Email</th>
                                <th scope="col">Skype</th>
                                <th scope="col">Linkedin</th>
                                <th scope="col">Twitter</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>
                                        @if($client->avatar)
                                            <img src="{{ $client->avatar_url }}" class="avatar mr-1">
                                        @endif
                                        {{ $client->name }}
                                    </td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->skype }}</td>
                                    <td>{{ $client->linkedin }}</td>
                                    <td>{{ $client->twitter }}</td>
                                    <td>
                                        <a href="/clients/{{ $client->id }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection