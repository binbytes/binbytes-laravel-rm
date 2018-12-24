<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

        $user = create(User::class);

        $this->get('/users')
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    /** @test */
    public function guest_cannot_create_user()
    {
        $user = raw(User::class);

        $this->post('/users', $user)
            ->assertRedirect('/login');
    }

    /** @test */
    public function validation_test_for_create_user()
    {
        $this->logIn();

        $user = raw(User::class, [
            'first_name' => null,
            'last_name' => null,
            'email' => null,
            'mobile_no' => null,
            'address' => null,
        ]);

        $this->json('POST', '/users', $user)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'mobile_no', 'address']);

        $userWitIncorrectMail = raw(User::class, [
            'email' => 'foobar',
        ]);

        $this->json('POST', '/users', $userWitIncorrectMail)
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');

        $userWithIncorrectDates = raw(User::class, [
            'dob' => 'test',
            'joining_date' => 'date',
            'leaving_date' => 'date',
        ]);

        $this->json('POST', '/users', $userWithIncorrectDates)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['dob', 'joining_date', 'leaving_date']);

        $userWithIncorrectNumbers = raw(User::class, [
            'weekly_hours_credit' => 'test',
            'base_salary' => 'test',
        ]);

        $this->json('POST', '/users', $userWithIncorrectNumbers)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['weekly_hours_credit', 'base_salary']);

        // Uniqueness
        $user = create(User::class);

        $newUser = raw(User::class, [
            'email' => $user->email,
            'username' => $user->username,
        ]);

        $this->json('POST', '/users', $newUser)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'username']);
    }

    /** @test */
    public function it_can_create_user_with_out_avatar()
    {
        $this->logIn();

        $user = raw(User::class);

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

        $user = raw(User::class, [
            'avatar' => $file = UploadedFile::fake()->image('user.jpg'),
        ]);

        $this->json('POST', '/users', $user)
            ->assertStatus(200);

        Storage::disk('public')->assertExists('users/'.$file->hashName());

        $this->get('/users')
            ->assertSee($user['first_name'])
            ->assertSee($user['email']);
    }
}
