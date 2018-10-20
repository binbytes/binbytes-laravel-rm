@extends('layouts.app', [
    'pageTitle' => 'Projects'
])

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="/projects/create" class="btn btn-primary pull-right">
                        <i class="fa fa-plus mr-2"></i>
                        Add Project
                    </a>
                </div>

                <div class="card-body">
                    @foreach($projects->chunk(3) as $chunkProjects)
                        <div class="card-deck">
                            @foreach($chunkProjects as $project)
                                <div class="col-sm-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <a href="{{ $project->path() }}">
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

                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection