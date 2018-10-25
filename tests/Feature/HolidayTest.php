<?php

namespace Tests\Feature;

use App\Holiday;
use App\Notifications\HolidayAdded;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Notification;
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

    /** @test */
    public function a_admin_user_can_create_holiday()
    {
        \Event::fake();
        $this->logIn(true);

        $holiday = raw(Holiday::class);

        $this->json('POST', '/holidays', $holiday)
            ->assertStatus(200);

        \Event::assertDispatched(\App\Events\HolidayAdded::class);

        $this->get('/holidays')
            ->assertSee($holiday['title']);
    }
}
