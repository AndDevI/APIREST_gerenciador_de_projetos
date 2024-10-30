<?php

namespace App\Http\Controllers;

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
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        return Project::create($request->all());
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
    public function update(Request $request, string $id) {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Project::destroy($id);
        return response()->noContent();
    }
}
