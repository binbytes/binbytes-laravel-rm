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
        $this->logIn();

        $project = create('App\Project');

        $this->get('/projects')
            ->assertSee($project->title);
    }

    /** @test */
    public function a_guest_can_not_create_project()
    {
        $project = make('App\Project');

        $this->json('POST', '/projects', $project->toArray())
            ->assertStatus(401);
    }

    /** @test */
    public function validation_test_for_project_create()
    {
        $this->logIn();

        $client = make('App\Project', [
            'title' => null,
            'client_id' => null
        ]);

        $this->json('POST', '/projects', $client->toArray())
            ->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'client_id']);

        // client_id must be valid client id
        $this->json('post', '/projects', factory('App\Project')->raw([
            'client_id' => 9999
        ]))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['client_id']);
    }

    /** @test */
    public function it_can_create_project_without_user()
    {
        $this->logIn();

        $project = raw('App\Project');

        $this->json('POST', '/projects', $project)
            ->assertStatus(200);

        $this->get('/projects')
            ->assertSee($project['title'])
            ->assertSee($project['description']);
    }

    /** @test */
    public function it_can_create_project_with_user()
    {
        $this->logIn();

        $userA = factory('App\User')->create();
        $userB = factory('App\User')->create();

        $project = raw('App\Project', [
            'users' => [
                $userA->id,
                $userB->id
            ]
        ]);

        $this->json('POST', '/projects', $project)
            ->assertStatus(200);

        $this->get('/projects')
            ->assertSee($project['title'])
            ->assertSee($project['description'])
            ->assertSee($userA->name)
            ->assertSee($userB->name);
    }
}
