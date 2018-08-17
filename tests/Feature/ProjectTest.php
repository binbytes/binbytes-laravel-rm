<?php

namespace Tests\Feature;

use App\Project;
use App\User;
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

        $project = create(Project::class);

        $this->get('/projects')
            ->assertSee($project->title);
    }

    /** @test */
    public function a_guest_can_not_create_project()
    {
        $project = make(Project::class);

        $this->json('POST', '/projects', $project->toArray())
            ->assertStatus(401);
    }

    /** @test */
    public function validation_test_for_project_create()
    {
        $this->logIn();

        $client = make(Project::class, [
            'title' => null,
            'client_id' => null
        ]);

        $this->json('POST', '/projects', $client->toArray())
            ->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'client_id']);

        // client_id must be valid client id
        $this->json('post', '/projects', factory(Project::class)->raw([
            'client_id' => 9999
        ]))
        ->assertStatus(422)
        ->assertJsonValidationErrors(['client_id']);
    }

    /** @test */
    public function it_can_create_project_without_user()
    {
        $this->logIn();

        $project = raw(Project::class);

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

        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();

        $project = raw(Project::class, [
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

    /** @test */
    public function it_can_see_project_detail_page()
    {
        $this->logIn();

        $project = factory(Project::class)->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
}
