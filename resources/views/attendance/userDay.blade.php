@extends('layouts.app', [
    'subTitle' => 'Attendance',
    'pageTitle' => 'View Today Log'
])

@section('content')
    <div class="row">
        <div class="col-lg-10 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    @if($user->avatar)
                        <img src="{{ $user->avatar_url }}" class="avatar">
                    @endif
                    <span>{{ $user->name }}</span>
                </div>
                <div class="card-body">
                    @if($attendance)
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>StartTime</th>
                                <th>EndTime</th>
                                <th>Total Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance->sessions as $session)
                                    <tr>
                                        <td>
                                            {{ $session->start_time->toTimeString() }}
                                        </td>
                                        <td>
                                            {{ $session->end_time->toTimeString() }}
                                        </td>
                                        <td>
                                            {{ $session->hours }}
                                        </td>
                                        <td>
                                            @if(! $loop->last)
                                                @if($session->updateRequest->count())
                                                    <span class="badge badge-warning text-white">Pending</span>
                                                @else
                                                <a href="/attendance/{{ $session->id }}/edit" aria-label="View">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right">
                                        <span class="text-light">Total Hours:</span> <strong>{{ $attendance->hours }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>No Attendance log available this day.</p>
                    @endif
                    <div class="row justify-content-end">
                        <a href="/dashboard" class="btn btn-link">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection