<?php

namespace Tests\Feature;

use App\Holiday;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HolidayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_user_cannot_see_holidays()
    {
        $this->get('/holidays')
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_authenticated_user_can_see_holidays()
    {
        $this->logIn();

        $holiday = create(Holiday::class);

        $this->get('/holidays')
            ->assertSee($holiday->title);
    }

    /** @test */
    public function a_guest_can_not_create_holiday()
    {
        $holiday = raw(Holiday::class);

        $this->json('POST', '/holidays', $holiday)
            ->assertStatus(401);
    }

    /** @test */
    public function a_normal_user_can_not_create_holiday()
    {
        $this->logIn();

        $holiday = raw(Holiday::class);

        $this->json('POST', '/holidays', $holiday)
            ->assertStatus(403);
    }
}
