<div class="col-md-8">
    <div class="card">
        <div class="card-header border-bottom pb-0">
            <h6 class="font-weight-bold">This week</h6>
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
                                {{ $attendance->date }}
                            </td>
                            <td>
                                {{ $attendance->hours }}
                            </td>
                            <td>
                                {{ $attendance->is_on_leave ? 'Yes' : '' }}
                            </td>
                            <td>
                                <a href="{{ route('day-attendance', $attendance->date) }}" aria-label="View">
                                    <i class="fa fa-edit"></i>
                                </a>
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