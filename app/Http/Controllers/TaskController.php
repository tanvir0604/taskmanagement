<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Casts\Json as CastsJson;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        // $projects = Project::withCount(['tasks'])->with(['tasks'])->where('status', true)->get();
        $projects = Project::where('status', true)->get();
        $tasks = Task::orderBy('priority', 'asc');
        if(!empty($request->project)){
            $tasks = $tasks->where('project_id', $request->project);
        }
        $tasks = $tasks->get();
        return view('task.index', ['projects' => $projects, 'tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $projects = Project::withCount(['tasks'])->get();
        return view('task.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'name' => 'required|max:255',
        ]);
        $priority = Task::orderBy('priority', 'desc')->first();
        
        if($priority){
            $priority = $priority->priority + 1;
        }else{
            $priority = 1;
        }
        $task = new Task();
        $task->name = $request->name;
        $task->project_id = $request->project;
        $task->priority = $priority;
        $task->created_at = date('Y-m-d H:i:s');
        $task->updated_at = date('Y-m-d H:i:s');
        if($task->save()){
            return redirect('/')->with('success', 'Task created successfully!');
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
        $projects = Project::withCount(['tasks'])->get();
        $task = Task::find($id);
        return view('task.edit', ['projects' => $projects, 'task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'project' => 'required',
            'name' => 'required|max:255',
        ]);
        $task = Task::find($id);
        $task->name = $request->name;
        $task->project_id = $request->project;
        if($task->save()){
            return redirect('/')->with('success', 'Task updated successfully!');
        }
        return redirect('/project')->with('error', 'Failed, please try again!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Task::find($id)->delete()){
            return redirect('/')->with('success', 'Task deleted successfully!');
        }
        return redirect('/project')->with('error', 'Failed, please try again!');
    }
    

    function updatePriority(Request $request) {
        $priorities = $ids = [];
        // extract all of the information to array
        for ($i=0; $i < count($request->item); $i++) {
            [$priorities[], $ids[]] = explode('s', $request->item[$i]);
        }
        // sort all priority data
        sort($priorities);
        
        // reassign sorted priority data
        foreach ($ids as $key => $value) {
            $task = Task::find($value);
            $task->priority = $priorities[$key];
            $task->save();
        }

        return response()->json(['status' => true]);
    }
}
