<?php

namespace App\Http\Controllers;

use App\User;

class AttendanceController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ping()
    {
        $attendance = auth()->user()->today_attendance;
        $attendance->incrementSession();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param User $user
     * @param $startDate
     * @param null $endDate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function dailyView(User $user, $startDate, $endDate = null)
    {
        if($this->authorize('seeWeeklyAttendance', $user)) {
            $weekAttendances = $user->dateRangeAttendances($startDate, $endDate);

            return view('attendance.day', compact('user', 'weekAttendances', 'startDate', 'endDate'));
        }
    }
}
