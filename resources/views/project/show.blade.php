@extends('layouts.app', [
    'subTitle' => 'Projects',
    'pageTitle' => 'View Project'
])

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    @if($project->client->avatar)
                        <div class="mb-3 mx-auto">
                            <img class="rounded-circle" src="{{ $project->client->avatar_url }}" alt="{{ $project->client->name }}" width="90" height="90">
                        </div>
                    @endif
                    <h5 class="mb-0">{{ $project->client->name }}</h5>
                    <div class="d-block pt-2">
                        @if($project->client->github)
                            <a href="{{ $project->client->github }}" class="mx-1"><i class="fab fa-github"></i></a>
                        @endif
                        @if($project->client->twitter)
                            <a href="{{ $project->client->twitter }}" class="mx-1"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($project->client->linkedin)
                            <a href="{{ $project->client->linkedin }}" class="mx-1"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if($project->client->facebook)
                            <a href="{{ $project->client->facebook }}" class="mx-1"><i class="fab fa-facebook-f"></i></a>
                        @endif
                    </div>
                </div>
                <div class="border-top border-bottom p-4">
                    @if($project->client->company_name)
                        <div class="mb-3">
                            <h6 class="mb-0">Company</h6>
                            <span class="text-muted">{{ $project->client->company_name }}</span>
                        </div>
                    @endif
                    <div class="mb-3">
                        <h6 class="mb-0">Email <i class="fas fa-envelope-open"></i></h6>
                        <span class="text-muted">{{ $project->client->email ?? '---'}}</span>
                    </div>
                    <div>
                        <h6 class="mb-0">Phone <i class="fas fa-phone"></i></h6>
                        <span class="text-muted">{{ $project->client->mobile_no ?? '---' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom pl-4">
                    <h4 class="mb-0 ml-2">{{ $project->title }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-8 border-right py-3 pl-5">
                            <p>{{ $project->description ?? '---' }}</p>
                            <div class="row px-1 pt-3">
                                <div class="col-3">
                                    <h6>Remarks</h6>
                                </div>
                                <div class="col-9">
                                    <p>{{ $project->remarks ?? '---' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 py-3">
                            @if($project->users->count())
                                <div class="d-flex p-2">
                                    @foreach($project->users as $user)
                                        <a href="/users/{{ $user->id }}">
                                            @if($user->avatar)
                                                <img src="{{ $user->avatar_url }}" class="avatar mr-1">
                                            @else
                                                <span class="user-placeholder mr-1">{{ substr($user->name, 0, 2) }}</span>
                                            @endif
                                            <span class="mr-1">{{ $user->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection