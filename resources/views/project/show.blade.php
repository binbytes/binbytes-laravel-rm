@extends('layouts.app', [
    'subTitle' => 'Projects',
    'pageTitle' => 'View Project'
])

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{ $project->title }}</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        @foreach($project->toArray() as $key => $value)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach

                        @if($project->users)
                            <tr>
                                <th>Users</th>
                                <td>{!! $project->users->pluck('name')->implode('<br>') !!}</td>
                            </tr>
                        @endif
                    </table>

                    <a href="/projects" class="btn btn-link">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection