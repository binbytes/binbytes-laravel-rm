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
                            <img class="rounded-circle" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" width="90" height="90">
                        </div>
                    @endif

                    <h4 class="mb-0">{{ $user->name }}</h4>
                    <span class="text-muted d-block mb-2">{{ $user->designation }}</span>
                    <div class="d-block mb-2">
                        @if($user->github)
                            <a href="{{ $user->github }}" class="mx-1"><i class="fab fa-github"></i></a>
                        @endif
                        @if($user->twitter)
                            <a href="{{ $user->twitter }}" class="mx-1"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($user->linkedin)
                            <a href="{{ $user->linkedin }}" class="mx-1"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if($user->facebook)
                            <a href="{{ $user->facebook }}" class="mx-1"><i class="fab fa-facebook-f"></i></a>
                        @endif
                    </div>
                </div>

                <div class="border-top border-bottom p-4">
                    <div class="mb-3">
                        <h6 class="mb-0">Email <i class="fas fa-envelope-open"></i></h6>
                        <span class="text-muted">{{ $user->email }}</span>
                    </div>
                    <div>
                        <h6 class="mb-0">Phone <i class="fas fa-phone"></i></h6>
                        <span class="text-muted">{{ $user->mobile_no }}</span>
                    </div>
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
                                     style="width: {{ $user->getWeeklyWorksHrsPercentage() }}%">
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
                <div class="card-header">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal Details</a>
                        </li>
                        @if(Gate::allows('showTab', $user))
                            <li class="nav-item">
                                <a class="nav-link" id="organizational-tab" data-toggle="tab" href="#organizational" role="tab" aria-controls="profile" aria-selected="false">Organizational</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body tab-content px-4 py-2">
                    <div class="tab-pane fade active show" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <div class="row">
                            <div class="col-5">
                                <h6 class="text-light">Basic info</h6>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Name</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $user->name }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Birthday</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">
                                            {{ $user->dob->toDateString() ?? '---' }}
                                            <i class="fas fa-birthday-cake ml-2"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="px-4">
                                    <h6 class="text-light">Contact info</h6>
                                    <div class="row">
                                        <div class="col-5">
                                            <h6>Address</h6>
                                        </div>
                                        <div class="col-7">
                                            <span class="text-muted">{{ $user->address ?? '---' }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <h6>Personal Email</h6>
                                        </div>
                                        <div class="col-7">
                                            <span class="text-muted">{{ $user->personal_email ?? '---' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-5">
                                <h6 class="text-light">Social info</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Skype</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $user->skype ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Trello</h6>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-muted">{{ $user->trello ?? '---' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="px-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>Slack</h6>
                                        </div>
                                        <div class="col-8">
                                            <span class="text-muted">{{ $user->slack ?? '---' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="organizational" role="tabpanel" aria-labelledby="organizational-tab">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-5">
                                        <h6>Joining Date</h6>
                                    </div>
                                    <div class="col-7">
                                        <span class="text-muted">{{ $user->joining_date->toDateString() ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    @if($user->leaving_date)
                                        <div class="col-5">
                                            <h6>Leaving Date</h6>
                                        </div>
                                        <div class="col-7">
                                            <span class="text-muted">{{ $user->leaving_date->toDateString() }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-5">
                                        <h6>Basic Salary</h6>
                                    </div>
                                    <div class="col-7">
                                        <span class="text-muted">
                                            <i class="fas fa-rupee-sign"></i>
                                            {{ $user->base_salary ?? '---' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <h6>Weekly Hours</h6>
                                    </div>
                                    <div class="col-7">
                                        <span class="text-muted">{{ $user->weekly_hours_credit ?? '---' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection