<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($projectId) {
        return Task::where('project_id', $projectId)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Project $project) {
        $task = $project->tasks()->create($request->validated());
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($projectId, $taskId) {
        return Task::where('project_id', $projectId)->findOrFail($taskId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Project $project, Task $task) {
        $task->update($request->validated());
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, $taskId) {
        Task::where('project_id', $projectId)->findOrFail($taskId)->delete();
        return response()->noContent();
    }
}
