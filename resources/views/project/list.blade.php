@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex mb-4">
            <h4>Projects</h4>

            <a href="/projects/create" class="btn btn-primary ml-auto">
                Add
            </a>
        </div>


        @foreach($projects->chunk(3) as $chunkProjects)
            <div class="card-deck">
                @foreach($chunkProjects as $project)
                    <div class="col-sm-4">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <a href="/projects/{{ $project->id }}">
                                    <h4 class="card-title">{{ $project->title }}</h4>
                                </a>
                                <p class="card-text">{{ $project->description }}</p>
                                @if($project->users)
                                    <p class="card-text">{!! $project->users->pluck('name')->implode('<br>') !!}</p>
                                @endif
                                <p class="card-text"><small class="text-muted">Created at {{ $project->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection