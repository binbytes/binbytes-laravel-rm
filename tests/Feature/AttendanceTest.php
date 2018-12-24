<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_login_user_must_create_attendance_and_session()
    {
        $user = create(User::class, [
            'email' => 'random@email.com',
            'password' => bcrypt('12345678'),
        ]);

        $this->json('POST', '/login', [
            'email' => 'random@email.com',
            'password' => '12345678',
        ])->assertRedirect('/dashboard');

        $this->assertDatabaseHas('user_attendances', [
            'user_id' => $user->getKey(),
            'date' => today(),
        ]);

        $this->assertDatabaseHas('attendance_sessions', [
            'user_id' => $user->getKey(),
            'start_time' => now()->toDateTimeString(),
            'end_time' => now()->toDateTimeString(),
        ]);
    }

    /**
     * @test
     */
    public function when_we_ping_it_must_increment_total_times()
    {
        $this->logIn();

        $totalTime = auth()->user()->today_attendance->totalTime;
        sleep(1);

        $this->get('/attendance/ping')
            ->assertSuccessful()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertGreaterThan(
            $totalTime,
            auth()->user()->today_attendance->totalTime
        );
    }
}
