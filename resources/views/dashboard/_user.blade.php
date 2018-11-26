<div class="col-md-6">
    <div class="card">
        <div class="card-header px-3 pb-0">
            <h6>Today Attendance</h6>
        </div>
        <div class="card-body p-0 pb-3">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="pl-3">Id</th>
                    <th>User</th>
                    <th>Today Hours</th>
                    <th>Week Hours</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="pl-3">{{ $user->id }}</td>
                            <td>
                                <a href="/users/{{ $user->id }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <?php
                                $color = '';
                                if(array_get($user->today_attendance, 'total_times') == 0) {
                                    $color = 'text-danger';
                                }
                            ?>
                            <td class="{{ $color }}">{{ hoursFromSeconds(array_get($user->today_attendance, 'total_times')) }}</td>
                            <?php
                            $color = '';
                            if($user->weekAttendances->sum('second') == 0) {
                                $color = 'text-danger';
                            }
                            ?>
                            <td class="{{ $color }}">{{ hoursFromSeconds($user->weekAttendances->sum('second')) }}</td>
                            <td>
                                <a href="{{ route('day-attendance', [$user->id, today()->format('Y-m-d'), today()->format('Y-m-d')]) }}" class="btn btn-white">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card card-small mb-4">
        <div class="card-header px-3 pb-0">
            <h6>Users Leave</h6>
        </div>
        <div class="card-body p-0 pb-3">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="pl-3">name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($leaves as $leave)
                    <tr>
                        <td class="pl-3">{{ $leave->user->name }}</td>
                        <td>{{ $leave->start_date->format('Y-m-d') }}</td>
                        <td>{{ $leave->end_date->format('Y-m-d') }}</td>
                        <?php
                        $color = '';
                        if($leave->approval_status == 'Approved') {
                            $color = "btn-success";
                        } elseif ($leave->approval_status == 'Declined') {
                            $color = "btn-danger";
                        } else {
                            $color = "btn-warning";
                        }
                        ?>
                        <td>
                            <a class="btn {{ $color }}" href="/leaves/{{$leave->id}}">
                                {{ $leave->approval_status }}
                            </a>
                        </td>
                    </tr>
                    @empty
                     <tr>
                         <td colspan="4" align="center">
                             No Leaves log available this day.
                         </td>
                     </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
