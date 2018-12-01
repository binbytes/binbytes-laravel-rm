@extends('layouts.app', [
    'subTitle' => 'Users',
    'pageTitle' => 'View User',
])
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    @include('shared.userAvatar')

                    <div class="d-block mt-2">
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

                <div class="border-top border-bottom px-4 py-3">
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
                                     aria-valuenow="{{ $user->week_attendances->sum('second') }}"
                                     aria-valuemin="0"
                                     aria-valuemax="{{ $user->weekly_hours_credit * 3600 }}"
                                     style="width: {{ $user->getWeeklyWorksHrsPercentage() }}%">
                                    <span class="progress-value text-semibold">
                                        {{ hoursFromSeconds($user->week_attendances->sum('second')) }} Hrs
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-4">
                        <strong class="text-muted d-block mb-2">About</strong>
                        <span>
                            {{ $user->about }}
                        </span>
                    </li>
                    <li class="list-group-item px-4">
                        <div class="row mb-2">
                            <div class="col-5">
                                <strong class="text-muted d-block">Date</strong>
                            </div>
                            <div class="col-7">
                                <strong class="text-muted d-block">Designation</strong>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <span>{{ $user->designation->pivot->created_at->toDateString() }}</span>
                            </div>
                            <div class="col-7">
                                <span>{{ $user->designation->title }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-4">
                        <div class="row justify-content-center mb-1">
                            <a class="btn btn-primary mr-1" href="/experience-letter/{{$user->id}}">Experience</a>
                            <a class="btn btn-primary mr-1" href="/joining-letter/{{$user->id}}">Joining</a>
                            <a class="btn btn-info" href="/users/promote/{{ $user->id }}"><i class="fas fa-star"> </i> promote</a>
                        </div>
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
                        @if(Gate::allows('userInfoTab', $user))
                            <li class="nav-item">
                                <a class="nav-link" id="organizational-tab" data-toggle="tab" href="#organizational" role="tab" aria-controls="profile" aria-selected="false">Organizational</a>
                            </li>
                        @endif
                        @if(Gate::allows('userInfoTab', $user))
                            <li class="nav-item">
                                <a class="nav-link" id="leaves-tab" data-toggle="tab" href="#leaves" role="tab" aria-controls="leaves" aria-selected="false">Leaves</a>
                            </li>
                        @endif
                        @if(Gate::allows('userInfoTab', $user))
                            <li class="nav-item">
                                <a class="nav-link" id="pdf-tab" data-toggle="tab" href="#pdf" role="tab" aria-controls="pdf" aria-selected="false">PDF File</a>
                            </li>
                        @endif
                        <div class="ml-auto">
                            <a href="/users/{{ $user->id }}/edit" class="btn btn-primary">Edit Profile</a>
                        </div>
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
                                            {{ $user->dob ?? '---' }}
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
                                        <span class="text-muted">{{ $user->joining_date ?? '---' }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    @if($user->leaving_date)
                                        <div class="col-5">
                                            <h6>Leaving Date</h6>
                                        </div>
                                        <div class="col-7">
                                            <span class="text-muted">{{ $user->leaving_date }}</span>
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
                    <div class="tab-pane fade" id="leaves" role="tabpanel" aria-labelledby="leaves-tab">
                        @if(count($leaves) <= 0)
                            <div class="row justify-content-center">
                                <span class="text-muted">No Leaves</span>
                            </div>
                        @else
                            <table class="table">
                                <tr>
                                    <th>Subject</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($leaves as $leave)
                                    <tr>
                                        <td>
                                            <span>{{ $leave->subject }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $leave->start_date->format('Y-m-d') }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $leave->end_date->format('Y-m-d') }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-white" href="/leaves/{{ $leave->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($leave->start_date >= today())
                                                    {{ html()->form('DELETE', route('leaves.destroy', $leave))->open() }}
                                                    <button type="submit" class="btn btn-white ml-2">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                    {{ html()->form()->close() }}
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="pdf" role="tabpanel" aria-labelledby="pdf-tab">
                        <table class="table">
                            <tr>
                                <th>PDF</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>Joining</td>
                                <td>
                                    <span class="text-muted">{{ $user->joining_date }}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-white mr-1" href="/joining-letter/{{$user->id}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-white" href="/download/joiningLetter/{{ $user->id }}">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @foreach($user->designations as $designation)
                            <tr>
                                <td>promote to {{ $designation->title }}</td>
                                <td>
                                    <span class="text-muted">{{ $designation->pivot->created_at->toDateString() }}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-white mr-1" href="/promote-letter/{{$user->id}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-white" href="/download/promoteLetter/{{ $user->id }}">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Weekly Performance Report</h6>
                    <div class="block-handle"></div>
                </div>
                <div class="card-body pt-0">
                    <canvas height="130" id="myChart" class="mt-3"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('shared.chart')