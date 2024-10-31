<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService) {
        $this->projectService = $projectService;
    }

    public function index() {
        return response()->json($this->projectService->getAllProjects());
    }

    public function store(ProjectRequest $request) {
        $project = $this->projectService->createProject($request->validated());
        return response()->json($project, 201);
    }

    public function show($id) {
        return response()->json($this->projectService->getProjectById($id));
    }

    public function update(ProjectRequest $request, $id) {
        $project = $this->projectService->updateProject($id, $request->validated());
        return response()->json($project);
    }

    public function destroy($id) {
        $this->projectService->deleteProject($id);
        return response()->json(null, 204);
    }
}
