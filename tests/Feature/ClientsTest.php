<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
            ->assertSee($client->name)
            ->assertSee($client->email);
    }

    /** @test */
    // Allow all users to create client for now, later on we will decide role
    public function an_user_can_create_client()
    {
        $this->be($user = factory('App\User')->create());

        $client = factory('App\Client')->raw();

        $this->json('POST', '/clients', $client)
            ->assertStatus(200);
    }
}
