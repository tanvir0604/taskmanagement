<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $projects = Project::withCount(['tasks'])->get();
        return view('project.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
        ]);
        $project = new Project();
        $project->name = $request->name;
        $project->created_at = date('Y-m-d H:i:s');
        $project->updated_at = date('Y-m-d H:i:s');
        if($project->save()){
            return redirect('/project')->with('success', 'Project created successfully!');
        }
        return redirect('/project')->with('error', 'Failed, please try again!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projectDetails = Project::find($id);
        return view('project.edit', ['project' => $projectDetails]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required','max:255',
                Rule::unique('projects')->ignore($id),
            ]
        ]);
        $project = Project::find($id);
        $project->name = $request->name;
        if($project->save()){
            return redirect('/project')->with('success', 'Project updated successfully!');
        }
        return redirect('/project')->with('error', 'Failed, please try again!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $project->tasks()->delete();
        if($project->delete()){
            return redirect('/project')->with('success', 'Project deleted successfully!');
        }
        return redirect('/project')->with('error', 'Failed, please try again!');
    }
}
