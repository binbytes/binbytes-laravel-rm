<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_user_can_not_see_users()
    {
        $this->get('/users')
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_see_users()
    {
        $this->be($user = factory('App\User')->create());

        $this->get('/users')
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    /** @test */
    public function guest_cannot_create_user()
    {
        $user = factory('App\User')->raw();

        $this->post('/users', $user)
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_can_create_user_with_out_avatar()
    {
        $this->be(factory('App\User')->create());

        $user = factory('App\User')->raw();

        $this->json('POST', '/users', $user)
            ->assertStatus(200);

        $this->get('/users')
            ->assertSee($user['name'])
            ->assertSee($user['email']);
    }

    /** @test */
    public function it_can_create_user_with_avatar()
    {
        Storage::fake('public');

        $this->be(factory('App\User')->create());

        $user = factory('App\User')->raw([
            'avatar' => $file = UploadedFile::fake()->image('user.jpg')
        ]);;

        $this->json('POST', '/users', $user)
            ->assertStatus(200);

        Storage::disk('public')->assertExists('users/' . $file->hashName());

        $this->get('/users')
            ->assertSee($user['name'])
            ->assertSee($user['email']);
    }
}
