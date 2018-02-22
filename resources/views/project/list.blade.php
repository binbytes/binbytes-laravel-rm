@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header d-flex">
                        <h4>Projects</h4>

                        <a href="/projects/create" class="btn btn-primary ml-auto">
                            Add
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Is Competed?</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->is_completed ? 'Yes' : '' }}</td>
                                    <td>
                                        <a href="/client/{{ $project->client_id }}">{{ $project->client->name }}</a>
                                    </td>
                                    <td>
                                        <a href="/projects/{{ $project->id }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection