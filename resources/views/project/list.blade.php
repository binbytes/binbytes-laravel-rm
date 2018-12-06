@extends('layouts.app', [
    'pageTitle' => 'Projects'
])

@section('content')
    <div class="row">
        <div class="col">
            @include('shared.alert')

            @if(Gate::allows('view', \App\Client::class))
                <project-list can_create="{{ \Gate::allows('create', \App\Project::class) }}"
                              :clients="{{ $clients->toJSON() }}"
                              :users="{{ $users->toJSON() }}" />
            @else
                <project-list can_create="{{ \Gate::allows('create', \App\Project::class) }}"
                              :clients="null"
                              :users="null" />
            @endif
        </div>
    </div>
@endsection