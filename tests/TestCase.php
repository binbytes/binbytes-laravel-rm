<?php

namespace Tests;

use App\User;
use App\UserAttendance;
use App\AttendanceSession;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function logIn($isAdmin = false)
    {
        // For now
        $user = create(User::class, $isAdmin ? [
            'email' => array_first(config('rm.admin')),
        ] : []);

        $attendance = create(UserAttendance::class, [
            'user_id' => $user->getKey(),
        ]);

        create(AttendanceSession::class, [
            'user_id' => $user->getKey(),
            'attendance_id' => $attendance->getKey(),
        ]);

        $this->be($user);
    }
}
