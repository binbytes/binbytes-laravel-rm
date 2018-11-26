@extends('layouts.app', [
    'subTitle' => 'Attendance',
    'pageTitle' => 'View Daily Log'
])

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="row m-0 mb-2">
                <div class="input-daterange input-group input-date-range pl-0 col-6">
                    <input type="text" id="start_date" name="start_date" class="form-control input-date" placeholder="Start Date">
                    <input type="text" id="end_date" name="end_date" class="form-control input-date" placeholder="End Date">
                </div>
                <input type="hidden" id="user" value="{{ $user->id }}">
                <a id="go" href="" class="btn btn-primary">Go</a>
            </div>

            <div class="card card-small mb-3">
                <div class="card-header border-bottom d-flex justify-content-between pb-0">
                    <h6 class="m-0">
                        @if($user->avatar)
                            <img src="{{ $user->avatar_url }}" class="avatar">
                        @endif
                        <span>{{ $user->name }}</span>
                    </h6>
                    <div>
                        @if($startDate === $endDate)
                            @if($attendance <> null)
                            <p class="badge badge-secondary">
                                {{ $attendance->date }}
                            </p>
                            @endif
                        @else
                            @if(empty($weekAttendances))
                            <p class="badge badge-secondary">
                                {{  $startDate }}
                            </p>
                            TO
                            <p class="badge badge-secondary">
                                {{  $endDate }}
                            </p>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    @if($startDate === $endDate)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Total Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($attendance <> null)
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
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" align="right">
                                        <span class="text-light">Total Hours:</span> <strong>{{ $attendance->hours }}</strong>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No Attendance log available this day.
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($weekAttendances as $attendance)
                                    <tr>
                                        <td>
                                            {{ array_get($attendance, 'date') }}
                                        </td>
                                        <td>
                                            {{ array_get($attendance, 'hours') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" align="center">
                                            No Attendance log available these days.
                                        </td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="3" align="right">
                                        <span class="text-light">Total Hours:</span>
                                        <strong>{{ hoursFromSeconds($weekAttendances->sum('total_times')) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    <a href="/dashboard" class="btn btn-link pull-right">Back</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#go').click(function(){
                let startDate = $('#start_date').val()
                let endDate = $('#end_date').val()
                let user = $('#user').val()

                $('#go').attr('href', "/attendance/day/" + user + "/" + startDate + "/" + endDate)
            })
        })
    </script>
@endpush