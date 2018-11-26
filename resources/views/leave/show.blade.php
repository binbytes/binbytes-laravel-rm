@extends('layouts.app', [
    'subTitle' => 'Leave',
    'pageTitle' => 'View Leave'
])

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    @if($leave->user->avatar)
                        <div class="mb-3 mx-auto">
                            <img class="rounded-circle" src="{{ $leave->user->avatar_url }}" alt="{{ $leave->user->name }}" width="90" height="90">
                        </div>
                    @endif
                    <h4 class="mb-0">{{ $leave->user->name }}</h4>
                </div>
                <div class="border-top border-bottom p-4">
                    <div class="mb-3">
                        <h6 class="mb-0">Email <i class="fas fa-envelope-open"></i></h6>
                        <span class="text-muted">{{ $leave->user->email }}</span>
                    </div>
                    <div>
                        <h6 class="mb-0">Phone <i class="fas fa-phone"></i></h6>
                        <span class="text-muted">{{ $leave->user->mobile_no }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom mx-2 pb-1">
                    <h4>{{ $leave->subject }}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row px-3">
                        <p> {{ $leave->description }} </p>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <h6>Duration:</h6>
                        </div>
                        <div class="col-10 px-0">
                            <span class="text-muted">{{ $leave->start_date->toDateString() }}
                                {{ $leave->start_date_partial_hours ? '('.$leave->start_date_partial_hours. 'hours)' : ''}}
                                <strong> To </strong>
                                {{ $leave->end_date->toDateString() }}
                            </span>
                        </div>
                    </div>
                    <div class="row ml-0 mt-2">
                        @if($leave->is_approved === null && Gate::allows('approval', $leave))
                            <a class="btn btn-success mr-3" href="/leave-approval/{{$leave->id}}/1">
                                <i class="fas fa-check"> </i>
                                Approved
                            </a>
                            <a class="btn btn-danger" href="/leave-approval/{{$leave->id}}/0">
                                <i class="fas fa-times"></i>
                                Declined
                            </a>
                        @else
                            <h6>Approval Status:</h6>
                            <?php
                                $color = '';
                                if($leave->approval_status == 'Approved') {
                                    $color = "text-success";
                                } elseif ($leave->approval_status == 'Declined') {
                                    $color = "text-danger";
                                } else {
                                    $color = "text-warning";
                                }
                            ?>
                            <span class="{{$color}} ml-2">
                                {{ $leave->approval_status }}
                            </span>
                        @endif
                        @if($leave->start_date >= today())
                            {{ html()->form('DELETE', route('leaves.destroy', $leave))->open() }}
                            <button type="submit" class="btn btn-primary ml-3">
                                <i class="fas fa-trash-alt"> </i> Delete
                            </button>
                            {{ html()->form()->close() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection