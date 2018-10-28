@extends('layouts.app', [
    'subTitle' => 'Users',
    'pageTitle' => 'View User'
])

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    @if($user->avatar)
                        <div class="mb-3 mx-auto">
                            <img class="rounded-circle" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" width="110">
                        </div>
                    @endif

                    <h4 class="mb-0">{{ $user->name }}</h4>
                    <span class="text-muted d-block mb-2">Project Manager</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4">
                        <div class="progress-wrapper">
                            <strong class="text-muted d-block mb-2">Current Week Hours</strong>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar"
                                     aria-valuenow="{{ $user->week_attendances->sum('hours') }}"
                                     aria-valuemin="0"
                                     aria-valuemax="{{ $user->weekly_hours_credit }}"
                                     style="width: {{ $user->getRemainingHrsPercentage() }}%">
                                    <span class="progress-value text-semibold">
                                        {{ $user->week_attendances->sum('hours') }} Hrs
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-4">
                        <strong class="text-muted d-block mb-2">About</strong>
                        <span>
                            {{ $user->about }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Account Details</h6>
                </div>
                <div class="card-body">
                    <strong>Name :</strong> <span>{{ $user->name }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection