@extends('layouts.app', [
    'subTitle' => 'Attendance',
    'pageTitle' => 'View Daily Log'
])

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h6 class="m-0">
                        @if($user->avatar)
                            <img src="{{ $user->avatar_url }}" class="avatar">
                        @endif
                        {{ $user->name }}
                    </h6>

                    <p class="badge badge-secondary">
                        {{ $attendance->date }}
                    </p>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>StartTime</th>
                                <th>EndTime</th>
                                <th>Total Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($attendance->sessions as $session)
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
                            </tr>
                        @empty
                            No Attendance log available this day.
                        @endforelse

                            <tr>
                                <td colspan="3" align="right">
                                    <span class="text-light">Total Hours:</span> <strong>{{ $attendance->hours }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="/projects" class="btn btn-link">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection