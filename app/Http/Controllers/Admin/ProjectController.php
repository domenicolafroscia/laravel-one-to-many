<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Project  $project
     * @param  StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $project->fill($form_data);

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('project_images', $request->cover_image);
            $project->cover_image = $path;
        }
       
        $project->save();

        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('message', 'New project: ' . ' ' . '"' . $project->title . '"' . ' ' . 'created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project_to_update = $request->validated();

        if($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $path = Storage::put('project_images', $request->cover_image);
            $project_to_update['cover_image'] = $path;
        }

        $project->update($project_to_update);

        return redirect()->route('admin.projects.show',['project' => $project->slug])->with('message', 'Element changes: ' . ' ' . '"' . $project->title . '"' . ' ' .'have been made');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        Storage::delete($project->cover_image);

        return redirect()->route('admin.projects.index')->with('message', 'The project: ' . '"' . $project->title . ':' . '"' . ' ' . 'has been moved to the trash');
    }
}
