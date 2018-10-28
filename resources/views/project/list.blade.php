@extends('layouts.app', [
    'pageTitle' => 'Projects'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            @can('create', App\Project::class)
                <div class="mb-5">
                    <a href="/projects/create" class="btn btn-primary pull-right">
                        <i class="fa fa-plus mr-2"></i>
                        Add Project
                    </a>
                </div>
            @endcan

            <div class="card-columns">
                @forelse($projects as $project)
                    <div class="card mb-3">
                        <div class="card-header pb-0 border-bottom d-flex justify-content-between">
                            <a href="{{ $project->path() }}">
                                <h4 class="card-title">{{ $project->title }}</h4>
                            </a>
                            <div class="d-flex">
                                @can('update', $project)
                                    <a class="btn btn-white" href="/projects/{{ $project->id }}/edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete', $project)
                                    {{ html()->form('DELETE', route('projects.destroy', $project))->open() }}
                                    <button type="submit" class="btn btn-white">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    {{ html()->form()->close() }}
                                @endcan
                            </div>
                        </div>
                        <div class="card-body py-4 border-bottom">
                            <p class="card-text">{{ $project->description }}</p>
                        </div>
                        <div class="card-footer">
                            @if($project->users->count())
                                <div class="d-flex">
                                    @foreach($project->users as $user)
                                        @if($user->avatar)
                                            <img src="{{ $user->avatar_url }}" class="avatar mr-1">
                                        @else
                                            <span class="user-placeholder mr-1">{{ substr($user->name, 0, 2) }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    No Projects
                @endforelse
            </div>
        </div>
    </div>
@endsection