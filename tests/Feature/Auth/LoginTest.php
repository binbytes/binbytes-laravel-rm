<?php

namespace Tests\Feature;

use App\Events\UserSignIn;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_must_valid_data_to_login()
    {
        create(User::class, [
            'email' => 'random@email.com',
            'password' => bcrypt('12345678')
        ]);

        $this->json('POST', '/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function a_valid_date_must_be_login()
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

        $this->assertTrue(auth()->id() == $user->getKey());
    }

    /** @test */
    public function a_login_must_broadcast_event()
    {
        $user = create(User::class, [
            'email' => 'random@email.com',
            'password' => bcrypt('12345678')
        ]);
        Event::fake([
            UserSignIn::class,
        ]);

        $this->json('POST', '/login', [
            'email' => 'random@email.com',
            'password' => '12345678'
        ])
            ->assertRedirect('/home');

        Event::assertDispatched(UserSignIn::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });

        Event::assertNotDispatched(AnotherJob::class);
    }
}
