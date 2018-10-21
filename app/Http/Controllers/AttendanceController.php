<?php

namespace App\Http\Controllers;

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
     * @param $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dailyView($date)
    {
        $user = auth()->user();
        $attendance = $user->attendanceOfTheDay($date);

        $attendance->load('sessions');

        return view('attendance.day', compact('user', 'attendance'));
    }
}
