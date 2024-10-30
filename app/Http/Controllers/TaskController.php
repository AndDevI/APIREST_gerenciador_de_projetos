<?php

namespace App\Http\Controllers;

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
    public function store(Request $request, $projectId) {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'nullable|date'
        ]);

        $task = new Task($request->all());
        $task->project_id = $projectId;
        $task->save();

        return $task;
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
    public function update(Request $request, $projectId, $taskId) {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        $task->update($request->all());

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, $taskId) {
        Task::where('project_id', $projectId)->findOrFail($taskId)->delete();
        return response()->noContent();
    }
}
