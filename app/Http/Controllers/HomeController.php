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
        //to get total hours for today.
        $totalTodayTimes = auth()->user()->today_attendance->totaltime;

        return view('home');
    }
}
