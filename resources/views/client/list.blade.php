@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header d-flex">
                        <h4>Clients</h4>

                        <a href="/clients/create" class="btn btn-primary ml-auto">
                            Add
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Skype</th>
                                <th>Linkedin</th>
                                <th>Twitter</th>
                                <th>Action</th>
                            </tr>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->skype }}</td>
                                    <td>{{ $client->linkedin }}</td>
                                    <td>{{ $client->twitter }}</td>
                                    <td>
                                        <a href="/clients/{{ $client->id }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection