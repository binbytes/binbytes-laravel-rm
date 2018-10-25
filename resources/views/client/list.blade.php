@extends('layouts.app', [
    'pageTitle' => 'Clients'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')
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
                                        <div class="row justify-content-center">
                                            <a class="btn btn-white" href="/clients/{{ $client->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            {{ html()->form('DELETE', route('clients.destroy', $client->id))->open() }}
                                                <button type="submit" class="btn btn-white">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            {{ html()->form()->close() }}
                                        </div>
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