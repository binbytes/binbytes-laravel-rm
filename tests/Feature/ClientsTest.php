<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClientsTest extends TestCase
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
        $this->be($user = factory('App\User')->create());

        $client = factory('App\Client')->create();

        $this->get('/clients')
            ->assertSee(htmlentities($client->name))
            ->assertSee($client->email);
    }

    /** @test */
    public function a_guest_can_not_create_client()
    {
        $client = factory('App\Client')->raw();

        $this->json('POST', '/clients', $client)
            ->assertStatus(401);
    }

    /** @test */
    public function validation_test_for_client_create()
    {
        $this->be($user = factory('App\User')->create());

        $client = factory('App\Client')->raw([
            'name' => null
        ]);

        $this->json('POST', '/clients', $client)
            ->assertStatus(422)
            ->assertJsonValidationErrors('name');

        // avatar must be image file
        $this->json('post', '/clients', factory('App\Client')->raw([
            'avatar' => 'test'
        ]))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['avatar']);

        // avatar must be image file
        $this->json('post', '/clients', factory('App\Client')->raw([
            'avatar' => 'test'
        ]))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['avatar']);
    }

    /** @test */
    // Allow all users to create client for now, later on we will decide role
    public function a_user_can_create_client_without_image()
    {
        $this->be($user = factory('App\User')->create());

        $client = factory('App\Client')->raw();

        $this->json('POST', '/clients', $client)
            ->assertStatus(200);

        $this->get('/clients')
            ->assertSee($client['name']);
    }

    /** @test */
    public function a_user_can_create_client_with_image()
    {
        Storage::fake('public');
        $this->be($user = factory('App\User')->create());

        $client = factory('App\Client')->raw([
            'avatar' => $file = UploadedFile::fake()->image('client.jpg')
        ]);

        $this->json('POST', '/clients', $client)
            ->assertStatus(200);

        Storage::disk('public')->assertExists('clients/' . $file->hashName());

        $this->get('/clients')
            ->assertSee($client['name']);
    }
}
