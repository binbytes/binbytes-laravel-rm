<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use App\Http\Requests\ProjectRequest;
use App\User;

class ProjectController extends Controller
{
    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()) {
            $projects = Project::with('client', 'users')->orderBy('priority', 'asc')->paginate();
        } else {
            $projects = auth()->user()->projects()->with('users')->latest()->paginate();
        }

        return view('project.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id');
        $users = User::select('first_name', 'last_name', 'id')->get();

        return view('project.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        $data['is_completed'] = $request->has('is_completed');

        $tags = $data['tag'] = explode(',', $request->get('tag'));

        $project = Project::create($data);

        $project->attachTags($tags);

        if($request->has('users')) {
            $project->users()->attach(request('users'));
        }

        if(request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = Client::pluck('name', 'id');
        $users = User::select('first_name', 'last_name', 'id')->get();

        return view('project.update', compact('project', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest  $request
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->all();

        $data['is_completed'] = $request->has('is_completed');

        $tags = $data['tag'] = explode(',', $request->get('tag'));

        $project->fill($data)->save();

        $project->syncTags($tags);
        $project->users()->sync(request('users'));

        if(request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return back();
    }
}
