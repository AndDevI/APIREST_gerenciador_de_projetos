<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Requests\TaskRequest;
use App\Models\Project;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    public function index() {
        return response()->json($this->taskService->getAllTasks());
    }

    public function store(Project $project, TaskRequest $request) {
        $taskData = $request->validated();
        $taskData['project_id'] = $project->id; 
        
        $task = $this->taskService->createTask($taskData);
        return response()->json($task, 201);
    }


    public function show($id) {
        return response()->json($this->taskService->getTaskById($id));
    }

    public function update(TaskRequest $request, $id) {
        $task = $this->taskService->updateTask($id, $request->validated());
        return response()->json($task);
    }

    public function destroy($id) {
        $this->taskService->deleteTask($id);
        return response()->json(null, 204);
    }
}
