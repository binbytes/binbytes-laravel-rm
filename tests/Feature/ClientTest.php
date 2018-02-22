<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_user_cannot_see_clients()
    {
        $this->get('/clients')
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_authenticated_user_can_see_clients()
    {
        $this->logIn();

        $client = create('App\Client');

        $this->get('/clients')
            ->assertSee($client->name)
            ->assertSee($client->email);
    }

    /** @test */
    public function a_guest_can_not_create_client()
    {
        $client = raw('App\Client');

        $this->json('POST', '/clients', $client)
            ->assertStatus(401);
    }

    /** @test */
    public function validation_test_for_client_create()
    {
        $this->logIn();

        $client = raw('App\Client', [
            'name' => null
        ]);

        $this->json('POST', '/clients', $client)
            ->assertStatus(422)
            ->assertJsonValidationErrors('name');

        // avatar must be image file
        $this->json('post', '/clients', raw('App\Client', [
            'avatar' => 'test'
        ]))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['avatar']);
    }

    /** @test */
    // Allow all users to create client for now, later on we will decide role
    public function a_user_can_create_client_without_image()
    {
        $this->logIn();

        $client = raw('App\Client');

        $this->json('POST', '/clients', $client)
            ->assertStatus(200);

        $this->get('/clients')
            ->assertSee($client['name']);
    }

    /** @test */
    public function a_user_can_create_client_with_image()
    {
        $this->logIn();
        Storage::fake('public');

        $client = raw('App\Client', [
            'avatar' => $file = UploadedFile::fake()->image('client.jpg')
        ]);

        $this->json('POST', '/clients', $client)
            ->assertStatus(200);

        Storage::disk('public')->assertExists('clients/' . $file->hashName());

        $this->get('/clients')
            ->assertSee($client['name']);
    }
}
