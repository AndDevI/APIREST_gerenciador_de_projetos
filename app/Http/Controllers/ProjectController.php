<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Project::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request) {
        $project = Project::create($request->validated());
        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        return Project::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project) {
        $project->update($request->validated());
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Project::destroy($id);
        return response()->noContent();
    }
}
