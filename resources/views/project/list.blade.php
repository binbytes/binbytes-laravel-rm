@extends('layouts.app', [
    'pageTitle' => 'Projects'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            <div class="row mb-3">
                <div class="btn-group ml-3">
                    <a href="/projects/filter/all" class="btn btn-info">All</a>
                    <a href="/projects/filter/completed" class="btn btn-info">Completed</a>
                    <a href="/projects/filter/running" class="btn btn-info">Running</a>
                </div>
                <div class="d-flex ml-3">
                    @can('index', \App\Client::class)
                        <select class="filter" class="mr-1">
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client }}">{{ $client }}</option>
                            @endforeach
                        </select>
                    @endcan
                    @admin
                        <select class="filter">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    @endadmin
                </div>
                @can('create', App\Project::class)
                    <a href="/projects/create" class="btn btn-primary ml-auto mr-3">
                        <i class="fa fa-plus mr-2"></i>
                        Add Project
                    </a>
                @endcan
            </div>

            <div class="card-columns">
                <project-list></project-list>
                @forelse($projects as $project)
                    <div class="card mb-3">
                        <div class="card-header pb-0">
                            <a href="{{ $project->path() }}">
                                <h4 class="card-title">{{ $project->title }}</h4>
                                <span class="text-reagent-gray">For <strong>{{ $project->client->name }}</strong></span>
                            </a>
                        </div>
                        <div class="card-body pb-3">
                            @if($project->users->count())
                                <div class="d-flex mb-2">
                                    @foreach($project->users as $user)
                                        <a href="/users/{{ $user->id }}">
                                            @if($user->avatar)
                                                <img src="{{ $user->avatar_url }}" class="avatar mr-1">
                                            @else
                                                <span class="user-placeholder mr-1">{{ substr($user->name, 0, 2) }}</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            @foreach($project->tags as $tag)
                                <span class="badge badge-primary">{{ $tag->name}}</span>
                            @endforeach
                        </div>
                        <div class="card-footer border-top text-light d-flex justify-content-between">
                            <span>
                                {{ $project->created_at->toDateString() }}
                            </span>

                            <div class="d-flex">
                                @can('update', $project)
                                    <a href="/projects/{{ $project->id }}/edit" class="btn btn-sm btn-white" aria-label="Edit">
                                        <i class="fas fa-small fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete', $project)
                                    {{ html()->form('DELETE', route('projects.destroy', $project))->open() }}
                                    <button type="submit" class="btn btn-sm btn-white" aria-label="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    {{ html()->form()->close() }}
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    No Projects
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.filter').change(function() {
                // TO DO
            })
        })
    </script>
@endpush