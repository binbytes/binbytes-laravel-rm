<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_user_cannot_see_projects()
    {
        $this->get('/projects')
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_authenticated_user_can_see_projects()
    {
        $this->be($user = factory('App\User')->create());

        $project = factory('App\Project')->create();

        $this->get('/projects')
            ->assertSee(htmlentities($project->title));
    }

    /** @test */
    public function a_guest_can_not_create_project()
    {
        $project = factory('App\Project')->raw();

        $this->json('POST', '/projects', $project)
            ->assertStatus(401);
    }

    /** @test */
    public function validation_test_for_client_create()
    {
        $this->be($user = factory('App\User')->create());

        $client = factory('App\Project')->raw([
            'title' => null,
            'client_id' => null
        ]);

        $this->json('POST', '/projects', $client)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'client_id']);

        // client_id must be valid client id
        $this->json('post', '/projects', factory('App\Project')->raw([
            'client_id' => 9999
        ]))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['client_id']);
    }
}
