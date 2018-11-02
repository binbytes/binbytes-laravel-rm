<div class="col-md-8">
    <div class="card">
        <div class="card-header border-bottom pb-0 d-flex justify-content-between">
            <h6 class="font-weight-bold">This week</h6>

            <h6 class="badge badge-outline-primary">
                {{ hoursFromSeconds($weekAttendances->sum('second')) }}

            </h6>
        </div>
        <div class="card-body p-0 pb-3 text-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Hours</th>
                        <th>On Leave</th>
                        <th></th>
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
                            <td>
                                {{ array_get($attendance, 'is_on_leave') ? 'Yes' : '' }}
                            </td>
                            <td>
                                @if(array_get($attendance, 'id'))
                                    <a href="{{ route('day-attendance', array_get($attendance, 'date')) }}" aria-label="View">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        No Attendance log available this week.
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>