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
        $this->logIn();

        $user = create('App\User');

        $this->get('/users')
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    /** @test */
    public function guest_cannot_create_user()
    {
        $user = raw('App\User');

        $this->post('/users', $user)
            ->assertRedirect('/login');
    }

    /** @test */
    public function validation_test_for_create_user()
    {
        $this->logIn();

        $user = raw('App\User', [
            'first_name' => null,
            'last_name' => null,
            'email' => null,
            'mobile_no' => null,
            'address' => null,
            'dob' => null
        ]);

        $this->json('POST', '/users', $user)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'mobile_no', 'address', 'dob']);

        $userWitIncorrectMail = raw('App\User', [
            'email' => 'foobar'
        ]);

        $this->json('POST', '/users', $userWitIncorrectMail)
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');

        $userWithIncorrectDob = raw('App\User', [
            'dob' => 'test'
        ]);

        $this->json('POST', '/users', $userWithIncorrectDob)
            ->assertStatus(422)
            ->assertJsonValidationErrors('dob');

        // Uniqueness
        $user = create('App\User');

        $newUser = raw('App\User', [
            'email' => $user->email,
            'username' => $user->username
        ]);

        $this->json('POST', '/users', $newUser)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'username']);
    }

    /** @test */
    public function it_can_create_user_with_out_avatar()
    {
        $this->logIn();

        $user = raw('App\User');

        $this->json('POST', '/users', $user)
            ->assertStatus(200);

        $this->get('/users')
            ->assertSee($user['first_name'])
            ->assertSee($user['email']);
    }

    /** @test */
    public function it_can_create_user_with_avatar()
    {
        $this->logIn();

        Storage::fake('public');

        $user = raw('App\User', [
            'avatar' => $file = UploadedFile::fake()->image('user.jpg')
        ]);;

        $this->json('POST', '/users', $user)
            ->assertStatus(200);

        Storage::disk('public')->assertExists('users/' . $file->hashName());

        $this->get('/users')
            ->assertSee($user['first_name'])
            ->assertSee($user['email']);
    }
}
