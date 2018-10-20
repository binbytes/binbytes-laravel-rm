@extends('layouts.app', [
    'pageTitle' => 'Projects'
])

@section('content')
    <div class="row">
        <div class="col">
            <div class="mb-5">
                <a href="/projects/create" class="btn btn-primary pull-right">
                    <i class="fa fa-plus mr-2"></i>
                    Add Project
                </a>
            </div>

            @foreach($projects->chunk(3) as $chunkProjects)
                <div class="row">
                    @foreach($chunkProjects as $project)
                        <div class="col-sm-4">
                            <div class="card mb-3">
                                <div class="card-header pb-0 border-bottom">
                                    <a href="{{ $project->path() }}">
                                        <h4 class="card-title">{{ $project->title }}</h4>
                                    </a>
                                </div>
                                <div class="card-body py-4 border-bottom">
                                    <p class="card-text">{{ $project->description }}</p>
                                </div>
                                @if($project->users->count())
                                    <div class="card-footer">
                                        <div class="d-flex">
                                            @foreach($project->users as $user)
                                                @if($user->avatar)
                                                    <img src="{{ $user->avatar_url }}" class="avatar mr-1">
                                                @else
                                                    <span class="user-placeholder mr-1">{{ substr($user->name, 0, 2) }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{ $projects->links() }}
        </div>
    </div>
@endsection