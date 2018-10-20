<?php

namespace Tests\Feature;

use App\AttendanceSession;
use App\User;
use App\UserAttendance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_login_user_must_create_attendance_and_session()
    {
        $user = create(User::class, [
            'email' => 'random@email.com',
            'password' => bcrypt('12345678')
        ]);

        $this->json('POST', '/login', [
            'email' => 'random@email.com',
            'password' => '12345678'
        ])
            ->assertRedirect('/home');

        $this->assertDatabaseHas('user_attendances', [
            'user_id' => $user->getKey(),
            'date' => today()
        ]);

        $this->assertDatabaseHas('attendance_sessions', [
            'user_id' => $user->getKey(),
            'start_time' => now(),
            'end_time' => now()
        ]);
    }

    /**
     * @test
     */
    public function when_we_ping_it_must_increment_total_times()
    {
        $this->userLogin();

        $totalTime = auth()->user()->today_attendance->totalTime;
        sleep(1);

        $this->get('/attendance/ping')
            ->assertSuccessful()
            ->assertJson([
                'success' => true
            ]);

        $this->assertGreaterThan(
            $totalTime,
            auth()->user()->today_attendance->totalTime
        );
    }

    protected function userLogin()
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
