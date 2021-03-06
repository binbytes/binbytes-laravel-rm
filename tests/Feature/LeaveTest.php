<?php

namespace Tests\Feature;

use App\Leave;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeaveTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_user_cannot_see_leaves()
    {
        $this->get('/leaves')
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_authenticated_user_can_see_leaves()
    {
        $this->logIn();

        $leave = create(Leave::class, [
            'user_id' => auth()->id(),
        ]);

        $this->get('/leaves')
            ->assertSee($leave->subject)
            ->assertSee(auth()->user()->name);
    }

    /** @test */
    public function a_guest_can_not_create_leave()
    {
        $leave = raw(Leave::class);

        $this->json('POST', '/leaves', $leave)
            ->assertStatus(401);
    }

    /** @test */
    public function a_normal_user_can_create_leave()
    {
        $this->logIn();

        $leave = raw(Leave::class);

        $this->json('POST', '/leaves', $leave)
            ->assertStatus(200);

        $this->get('/leaves')
            ->assertSee($leave['subject'])
            ->assertSee(auth()->user()->name);
    }
}
