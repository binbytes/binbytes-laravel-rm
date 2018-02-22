@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $project->title }}</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            @foreach($project->toArray() as $key => $value)
                                <tr>
                                    <th>{{ $key }}</th>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <a href="/projects" class="btn btn-link">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection