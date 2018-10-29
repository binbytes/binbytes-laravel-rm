@extends('layouts.app', [
    'pageTitle' => 'All Notifications'
])

@section('content')
    <div class="container pg-dashboard">
        @forelse($notifications as $key => $values)
            <div class="row mb-3">
                <h6 class="text">{{ $key }}</h6>
                <div class="card col-12">
                    <div class="card-body pb-0">
                        <ul class="list-unstyled">
                            @foreach($values as $notification)
                                <li>
                                    @include('notification')
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">
                No Notifications
            </div>
        @endforelse
    </div>
@endsection
