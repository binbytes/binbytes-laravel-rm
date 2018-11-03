<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all attendances log for week
        $weekAttendances = auth()->user()->week_attendances;
        $todayAttendance = auth()->user()->today_attendance;

        //dd($weekAttendances);

        return view('home', compact('weekAttendances', 'todayAttendance'));
    }
}
