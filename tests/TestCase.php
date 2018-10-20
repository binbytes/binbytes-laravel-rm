<?php

namespace Tests;

use App\AttendanceSession;
use App\User;
use App\UserAttendance;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function logIn()
    {
        $user = create(User::class);
        $attendance = create(UserAttendance::class, [
            'user_id' => $user->getKey()
        ]);

        create(AttendanceSession::class, [
            'user_id' => $user->getKey(),
            'attendance_id' => $attendance->getKey(),
        ]);

        $this->be($user);
    }
}
