<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\AttendanceSession;
use App\AttendanceSessionUpdate;
use App\Http\Requests\AttendanceUpdate;

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
            'success' => true,
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
        $this->authorize('seeWeeklyAttendance', $user);

        $weekAttendances = $user->dateRangeAttendances(
            Carbon::parse($startDate), Carbon::parse($endDate)->setTime(23, 59, 59)
        );

        return view('attendance.day', compact('user', 'weekAttendances', 'startDate', 'endDate'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $user = User::findOrfail($id);

        $this->authorize('show', $user);

        $attendance = $user->today_attendance;

        return view('attendance.userDay', compact('attendance', 'user'));
    }

    /**
     * @param AttendanceSession $attendanceSession
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(AttendanceSession $attendanceSession)
    {
        $this->authorize('update', auth()->user());

        return view('attendance.sessionsEdit', compact('attendanceSession'));
    }

    public function update(AttendanceUpdate $request, AttendanceSession $attendanceSession)
    {
        $data = $request->all();
        $data['session_id'] = $attendanceSession->id;

        AttendanceSessionUpdate::create($data);

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/dashboard');
    }

    /**
     * @param AttendanceSessionUpdate $sessionUpdate
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function approvedRequest(AttendanceSessionUpdate $sessionUpdate, $request)
    {
        $this->authorize('approvedAttendance', \App\User::class);

        if ($request) {
            $sessionUpdate->attendanceSession->updateAttendanceSession($sessionUpdate);
        }

        $sessionUpdate->delete();

        return back();
    }
}
