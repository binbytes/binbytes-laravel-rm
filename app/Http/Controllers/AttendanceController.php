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
}
