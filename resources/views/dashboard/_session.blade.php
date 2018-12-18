<div class="col-md-12">
    <div class="card">
        <div class="card-header border-bottom pb-0 d-flex justify-content-between">
            <h6>Today Attendance Request</h6>
        </div>
        <div class="card-body p-0 pb-3 text-center">
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Old</th>
                        <th>New/Requested</th>
                        <th>Note</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessionAttendances as $sessionAttendance)
                        <tr>
                            <td>{{ $sessionAttendance->attendanceSession->user->name }}</td>
                            <td>{{ $sessionAttendance->start_time->format('Y-m-d') }}</td>
                            <td>
                                {{ $sessionAttendance->attendanceSession->start_time->format('H:i:s') }} to
                                {{ $sessionAttendance->attendanceSession->end_time->format('H:i:s') }}
                            </td>
                            <td>
                                {{ $sessionAttendance->start_time->format('H:i:s') }} to
                                {{ $sessionAttendance->end_time->format('H:i:s') }}
                            </td>
                            <td>{{ $sessionAttendance->note }}</td>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-success mr-1" href="/attendance/request/{{$sessionAttendance->id}}/1">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a class="btn btn-danger" href="/attendance/request/{{$sessionAttendance->id}}/0">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>