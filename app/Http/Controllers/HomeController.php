<?php

namespace App\Http\Controllers;

use App\AttendanceSessionUpdate;
use App\Client;
use App\Leave;
use App\Project;
use App\User;

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

        $users = User::whereExcludeFromAttendance(false)->get();
        $projects = Project::all();
        $clients = Client::all();
        $leaves = Leave::with('user')
                    ->where('start_date', today())
                    ->get();
        $sessionAttendances = AttendanceSessionUpdate::with('attendanceSession')
                            ->get();

        return view('home', compact('weekAttendances', 'todayAttendance', 'users', 'leaves', 'projects', 'clients', 'sessionAttendances'));
    }
}
